<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAssignRequest;
use App\Http\Requests\CancelTripRequest;
use App\Http\Requests\CompleteTripRequest;
use App\Http\Requests\ManagerApproveRequest;
use App\Http\Requests\StartTripRequest;
use App\Http\Requests\VehicleRequestStoreRequest;
use App\Http\Requests\VehicleRequestUpdateRequest;
use App\Models\Notification;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleRequestController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = VehicleRequest::query()->with('borrower', 'vehicle', 'driver');

        if ($user->role === 'admin') {
            // Admin sees all
        } elseif ($user->role === 'manager') {
            $subordinateIds = $user->subordinates()->pluck('id');
            $query->where(function ($q) use ($user, $subordinateIds) {
                $q->where('borrower_id', $user->id)
                    ->orWhereIn('borrower_id', $subordinateIds);
            });
        } elseif ($user->role === 'driver') {
            $query->where('driver_id', $user->id);
        } else {
            $query->where('borrower_id', $user->id)->with('vehicle', 'driver');
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('destination', 'like', '%'.$request->search.'%')
                    ->orWhereHas('borrower', function ($q) use ($request) {
                        $q->where('name', 'like', '%'.$request->search.'%');
                    });
            });
        }

        if ($request->sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $requests = $query->paginate(15)->appends($request->query());

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store(VehicleRequestStoreRequest $request)
    {
        $user = Auth::user();
        $isManager = $user->role === 'manager';

        $vehicleRequest = VehicleRequest::create([
            'borrower_id' => $user->id,
            'destination' => $request->destination,
            'purpose' => $request->purpose,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => $isManager ? 'manager_approved' : 'pending',
            'approved_by' => $isManager ? $user->id : null,
        ]);

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'request_id' => $vehicleRequest->id,
                'type' => 'request_created',
                'title' => 'New Vehicle Request',
                'message' => "{$user->name} has submitted a new vehicle request.",
            ]);
        }

        return redirect()->route('requests.index')->with('success', 'Request submitted successfully.');
    }

    public function show(VehicleRequest $vehicleRequest)
    {
        $vehicleRequest->load('borrower', 'vehicle', 'driver', 'usageRecord', 'approver', 'assigner');

        return view('requests.show', ['request' => $vehicleRequest]);
    }

    public function managerApprove(ManagerApproveRequest $request, VehicleRequest $vehicleRequest)
    {
        if ($request->action === 'approve') {
            $vehicleRequest->update([
                'status' => 'manager_approved',
                'manager_notes' => $request->notes,
                'approved_by' => Auth::id(),
            ]);

            Notification::create([
                'user_id' => $vehicleRequest->borrower_id,
                'request_id' => $vehicleRequest->id,
                'type' => 'request_approved',
                'title' => 'Request Approved by Manager',
                'message' => 'Your vehicle request has been approved by the manager.',
            ]);
        } else {
            $vehicleRequest->update([
                'status' => 'manager_rejected',
                'manager_notes' => $request->notes,
                'approved_by' => Auth::id(),
            ]);

            Notification::create([
                'user_id' => $vehicleRequest->borrower_id,
                'request_id' => $vehicleRequest->id,
                'type' => 'request_rejected',
                'title' => 'Request Rejected by Manager',
                'message' => 'Your vehicle request has been rejected by the manager.',
            ]);
        }

        return redirect()->route('requests.index')->with('success', 'Request processed successfully.');
    }

    public function adminAssign(AdminAssignRequest $request, VehicleRequest $vehicleRequest)
    {
        if ($request->action === 'reject') {
            $vehicleRequest->update([
                'status' => 'admin_rejected',
                'admin_notes' => $request->notes,
                'assigned_by' => Auth::id(),
            ]);

            Notification::create([
                'user_id' => $vehicleRequest->borrower_id,
                'request_id' => $vehicleRequest->id,
                'type' => 'request_rejected',
                'title' => 'Request Rejected',
                'message' => 'Your vehicle request has been rejected by admin.',
            ]);

            return redirect()->route('requests.index')->with('success', 'Request rejected successfully.');
        }

        $vehicle = Vehicle::find($request->vehicle_id);

        $vehicleRequest->update([
            'status' => 'admin_approved',
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'admin_notes' => $request->notes,
            'assigned_by' => Auth::id(),
        ]);

        $vehicle->update(['availability' => 'in_use']);

        Notification::create([
            'user_id' => $vehicleRequest->borrower_id,
            'request_id' => $vehicleRequest->id,
            'type' => 'request_approved',
            'title' => 'Request Approved',
            'message' => 'Your vehicle request has been approved. Vehicle and driver assigned.',
        ]);

        if ($vehicleRequest->driver) {
            Notification::create([
                'user_id' => $vehicleRequest->driver_id,
                'request_id' => $vehicleRequest->id,
                'type' => 'trip_assigned',
                'title' => 'New Trip Assigned',
                'message' => "You have been assigned to a trip to {$vehicleRequest->destination}.",
            ]);
        }

        return redirect()->route('requests.index')->with('success', 'Request processed successfully.');
    }

    public function startTrip(StartTripRequest $request, VehicleRequest $vehicleRequest)
    {
        $vehicleRequest->usageRecord()->create([
            'start_km' => $request->start_km,
            'start_time' => now(),
        ]);

        $vehicleRequest->update(['status' => 'in_progress']);

        Notification::create([
            'user_id' => $vehicleRequest->borrower_id,
            'request_id' => $vehicleRequest->id,
            'type' => 'trip_started',
            'title' => 'Trip Started',
            'message' => 'Your trip has been started by the driver.',
        ]);

        return redirect()->route('requests.index')->with('success', 'Trip started. Please complete the trip when finished.');
    }

    public function complete(CompleteTripRequest $request, VehicleRequest $vehicleRequest)
    {
        $usageRecord = $vehicleRequest->usageRecord;

        if ($usageRecord) {
            $usageRecord->update([
                'end_km' => $request->end_km,
                'end_time' => now(),
                'fuel_used' => $request->fuel_used,
                'notes' => $request->notes,
            ]);
        }

        if ($vehicleRequest->vehicle) {
            $vehicleRequest->vehicle->update([
                'availability' => 'available',
                'current_kilometer' => $request->end_km,
            ]);
        }

        $vehicleRequest->update(['status' => 'completed']);

        Notification::create([
            'user_id' => $vehicleRequest->borrower_id,
            'request_id' => $vehicleRequest->id,
            'type' => 'trip_completed',
            'title' => 'Trip Completed',
            'message' => 'Your vehicle request has been completed. Thank you!',
        ]);

        return redirect()->route('requests.index')->with('success', 'Trip completed successfully.');
    }

    public function startTripSimple(Request $request, VehicleRequest $vehicleRequest)
    {
        if (Auth::id() !== $vehicleRequest->driver_id) {
            return back()->with('error', 'Unauthorized');
        }

        if ($vehicleRequest->status !== 'admin_approved') {
            return back()->with('error', 'Trip cannot be started');
        }

        $vehicleRequest->usageRecord()->create([
            'start_km' => $vehicleRequest->vehicle?->current_kilometer ?? 0,
            'start_time' => now(),
        ]);

        $vehicleRequest->update(['status' => 'in_progress']);

        if ($vehicleRequest->vehicle) {
            $vehicleRequest->vehicle->update(['availability' => 'in_use']);
        }

        Notification::create([
            'user_id' => $vehicleRequest->borrower_id,
            'request_id' => $vehicleRequest->id,
            'type' => 'trip_started',
            'title' => 'Trip Started',
            'message' => 'Your trip has been started by the driver.',
        ]);

        return redirect()->route('requests.index')->with('success', 'Trip started! You can update KM later when ending.');
    }

    public function updateStartKm(Request $request, VehicleRequest $vehicleRequest)
    {
        if (Auth::id() !== $vehicleRequest->driver_id) {
            return back()->with('error', 'Unauthorized');
        }

        if ($vehicleRequest->status !== 'in_progress') {
            return back()->with('error', 'Trip is not in progress');
        }

        if (! $vehicleRequest->usageRecord) {
            return back()->with('error', 'No usage record found');
        }

        $vehicleRequest->usageRecord->update([
            'start_km' => $request->start_km,
        ]);

        return back()->with('success', 'Start KM updated successfully.');
    }

    public function endTripSimple(Request $request, VehicleRequest $vehicleRequest)
    {
        if (Auth::id() !== $vehicleRequest->driver_id) {
            return back()->with('error', 'Unauthorized');
        }

        if ($vehicleRequest->status !== 'in_progress') {
            return back()->with('error', 'Trip is not in progress');
        }

        $usageRecord = $vehicleRequest->usageRecord;

        if ($usageRecord) {
            $usageRecord->update([
                'end_km' => $vehicleRequest->vehicle?->current_kilometer ?? 0,
                'end_time' => now(),
                'notes' => $request->notes ?? '',
            ]);
        }

        if ($vehicleRequest->vehicle) {
            $vehicleRequest->vehicle->update(['availability' => 'available']);
        }

        $vehicleRequest->update(['status' => 'completed']);

        Notification::create([
            'user_id' => $vehicleRequest->borrower_id,
            'request_id' => $vehicleRequest->id,
            'type' => 'trip_completed',
            'title' => 'Trip Completed',
            'message' => 'Your vehicle request has been completed. Thank you!',
        ]);

        return redirect()->route('requests.index')->with('success', 'Trip completed! You can update KM later in the details.');
    }

    public function adminStartTrip(Request $request, VehicleRequest $vehicleRequest)
    {
        $request->validate([
            'start_km' => 'required|numeric|min:0',
            'start_time' => 'required|date',
        ]);

        if ($vehicleRequest->status !== 'admin_approved') {
            return back()->with('error', 'Trip must be admin approved before starting');
        }

        $vehicleRequest->usageRecord()->create([
            'start_km' => $request->start_km,
            'start_time' => $request->start_time,
        ]);

        $vehicleRequest->update(['status' => 'in_progress']);

        Notification::create([
            'user_id' => $vehicleRequest->borrower_id,
            'request_id' => $vehicleRequest->id,
            'type' => 'trip_started',
            'title' => 'Trip Started',
            'message' => 'Your trip has been started by the admin.',
        ]);

        return redirect()->route('requests.index')->with('success', 'Trip started with custom timestamp.');
    }

    public function adminEndTrip(Request $request, VehicleRequest $vehicleRequest)
    {
        $request->validate([
            'end_km' => 'required|numeric|min:0',
            'end_time' => 'required|date',
            'fuel_used' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        if ($vehicleRequest->status !== 'in_progress') {
            return back()->with('error', 'Trip is not in progress');
        }

        $usageRecord = $vehicleRequest->usageRecord;

        if ($usageRecord) {
            $usageRecord->update([
                'end_km' => $request->end_km,
                'end_time' => $request->end_time,
                'fuel_used' => $request->fuel_used,
                'notes' => $request->notes,
            ]);
        }

        if ($vehicleRequest->vehicle) {
            $vehicleRequest->vehicle->update([
                'availability' => 'available',
                'current_kilometer' => $request->end_km,
            ]);
        }

        $vehicleRequest->update(['status' => 'completed']);

        Notification::create([
            'user_id' => $vehicleRequest->borrower_id,
            'request_id' => $vehicleRequest->id,
            'type' => 'trip_completed',
            'title' => 'Trip Completed',
            'message' => 'Your vehicle request has been completed by the admin.',
        ]);

        return redirect()->route('requests.index')->with('success', 'Trip completed with custom timestamps.');
    }

    public function cancel(CancelTripRequest $request, VehicleRequest $vehicleRequest)
    {
        if (Auth::user()->role !== 'driver') {
            return redirect()->route('requests.index')->with('error', 'Only drivers can cancel trips.');
        }

        if (! in_array($vehicleRequest->status, ['admin_approved', 'in_progress'])) {
            return redirect()->route('requests.index')->with('error', 'This trip cannot be cancelled.');
        }

        if ($vehicleRequest->vehicle) {
            $vehicleRequest->vehicle->update(['availability' => 'available']);
        }

        if ($vehicleRequest->driver_id) {
            $vehicleRequest->update([
                'driver_id' => null,
                'status' => 'driver_cancelled',
                'admin_notes' => ($vehicleRequest->admin_notes ?? '')."\n[CANCELLED] Driver: ".Auth::user()->name.' - Reason: '.$request->cancel_reason,
            ]);

            Notification::create([
                'user_id' => $vehicleRequest->borrower_id,
                'request_id' => $vehicleRequest->id,
                'type' => 'trip_cancelled',
                'title' => 'Trip Cancelled',
                'message' => 'Your trip has been cancelled by the driver. Reason: '.$request->cancel_reason,
            ]);
        } else {
            $vehicleRequest->update(['status' => 'pending']);
        }

        return redirect()->route('requests.index')->with('success', 'Trip cancelled successfully. Status: '.$vehicleRequest->status);
    }

    public function edit(VehicleRequest $vehicleRequest)
    {
        $user = Auth::user();

        // Only the borrower can edit if pending, or admin can edit anytime
        if ($user->role !== 'admin' && ($vehicleRequest->borrower_id !== $user->id || $vehicleRequest->status !== 'pending')) {
            return redirect()->route('requests.index')->with('error', 'You cannot edit this request.');
        }

        return view('requests.edit', compact('vehicleRequest'));
    }

    public function update(VehicleRequestUpdateRequest $request, VehicleRequest $vehicleRequest)
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && ($vehicleRequest->borrower_id !== $user->id || $vehicleRequest->status !== 'pending')) {
            return redirect()->route('requests.index')->with('error', 'You cannot update this request.');
        }

        $vehicleRequest->update($request->validated());

        return redirect()->route('requests.index')->with('success', 'Request updated successfully.');
    }

    public function destroy(VehicleRequest $vehicleRequest)
    {
        $user = Auth::user();

        // Only the borrower can delete if pending, or admin can delete
        if ($user->role !== 'admin' && ($vehicleRequest->borrower_id !== $user->id || $vehicleRequest->status !== 'pending')) {
            return redirect()->route('requests.index')->with('error', 'You cannot delete this request.');
        }

        $vehicleRequest->delete();

        return redirect()->route('requests.index')->with('success', 'Request deleted successfully.');
    }
}
