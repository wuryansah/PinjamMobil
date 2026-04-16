<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Models\VehicleRequest;
use App\Repositories\FuelRepository;
use App\Repositories\VehicleRequestRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleRequestService
{
    public function __construct(
        protected NotificationService $notificationService,
        protected VehicleRequestRepository $requestRepository,
        protected FuelRepository $fuelRepository
    ) {
    }

    public function getFilteredRequests(Request $request): LengthAwarePaginator
    {
        return $this->requestRepository->paginated($request);
    }

    public function create(Request $request): VehicleRequest
    {
        $user = Auth::user();

        return DB::transaction(function () use ($request, $user) {
            $vehicleRequest = $this->requestRepository->create([
                'borrower_id' => $user->id,
                'destination' => $request->destination,
                'purpose' => $request->purpose,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'status' => 'pending',
            ]);

            $this->notificationService->notifyAdmins(
                $vehicleRequest->id,
                'request_created',
                'New Vehicle Request',
                "{$user->name} has submitted a new vehicle request."
            );

            return $vehicleRequest;
        });
    }

    public function managerApprove(Request $request, VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($request, $vehicleRequest) {
            $status = $request->action === 'approve' ? 'manager_approved' : 'manager_rejected';
            $title = $request->action === 'approve' ? 'Request Approved by Manager' : 'Request Rejected by Manager';
            $message = $request->action === 'approve'
                ? 'Your vehicle request has been approved by the manager.'
                : 'Your vehicle request has been rejected by the manager.';

            $vehicleRequest->update([
                'status' => $status,
                'manager_notes' => $request->notes,
                'approved_by' => Auth::id(),
            ]);

            $this->notificationService->notifyUser(
                $vehicleRequest->borrower,
                $vehicleRequest->id,
                'request_approved',
                $title,
                $message
            );

            return $vehicleRequest;
        });
    }

    public function adminAssign(Request $request, VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($request, $vehicleRequest) {
            $vehicle = Vehicle::find($request->vehicle_id);

            if ($request->action === 'approve') {
                $vehicleRequest->update([
                    'status' => 'admin_approved',
                    'vehicle_id' => $request->vehicle_id,
                    'driver_id' => $request->driver_id,
                    'admin_notes' => $request->notes,
                    'assigned_by' => Auth::id(),
                ]);

                $vehicle->update(['availability' => 'in_use']);

                $this->notificationService->notifyUser(
                    $vehicleRequest->borrower,
                    $vehicleRequest->id,
                    'request_approved',
                    'Request Approved',
                    'Your vehicle request has been approved. Vehicle and driver assigned.'
                );

                if ($vehicleRequest->driver) {
                    $this->notificationService->notifyUser(
                        $vehicleRequest->driver,
                        $vehicleRequest->id,
                        'trip_assigned',
                        'New Trip Assigned',
                        "You have been assigned to a trip to {$vehicleRequest->destination}."
                    );
                }
            } else {
                $vehicleRequest->update([
                    'status' => 'admin_rejected',
                    'admin_notes' => $request->notes,
                    'assigned_by' => Auth::id(),
                ]);

                $this->notificationService->notifyUser(
                    $vehicleRequest->borrower,
                    $vehicleRequest->id,
                    'request_rejected',
                    'Request Rejected',
                    'Your vehicle request has been rejected by admin.'
                );
            }

            return $vehicleRequest;
        });
    }

    public function startTrip(Request $request, VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($request, $vehicleRequest) {
            $vehicleRequest->usageRecord()->create([
                'start_km' => $request->start_km,
                'start_time' => now(),
            ]);

            $vehicleRequest->update(['status' => 'in_progress']);

            $this->notificationService->notifyUser(
                $vehicleRequest->borrower,
                $vehicleRequest->id,
                'trip_started',
                'Trip Started',
                'Your trip has been started by the driver.'
            );

            return $vehicleRequest;
        });
    }

    public function complete(Request $request, VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($request, $vehicleRequest) {
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
                    'current_kilometer' => $request->end_km
                ]);
            }

            $vehicleRequest->update(['status' => 'completed']);

            $this->notificationService->notifyUser(
                $vehicleRequest->borrower,
                $vehicleRequest->id,
                'trip_completed',
                'Trip Completed',
                'Your vehicle request has been completed. Thank you!'
            );

            return $vehicleRequest;
        });
    }

    public function cancel(Request $request, VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($request, $vehicleRequest) {
            if ($vehicleRequest->vehicle) {
                $vehicleRequest->vehicle->update(['availability' => 'available']);
            }

            if ($vehicleRequest->driver_id) {
                $vehicleRequest->update([
                    'driver_id' => null,
                    'status' => 'driver_cancelled',
                    'admin_notes' => ($vehicleRequest->admin_notes ?? '').
                        "\n[CANCELLED] Driver: ".Auth::user()->name.' - Reason: '.$request->cancel_reason,
                ]);

                $this->notificationService->notifyUser(
                    $vehicleRequest->borrower,
                    $vehicleRequest->id,
                    'trip_cancelled',
                    'Trip Cancelled',
                    'Your trip has been cancelled by the driver. Reason: '.$request->cancel_reason
                );
            } else {
                $vehicleRequest->update(['status' => 'pending']);
            }

            return $vehicleRequest;
        });
    }

    public function startTripSimple(VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($vehicleRequest) {
            $vehicleRequest->usageRecord()->create([
                'start_km' => $vehicleRequest->vehicle?->current_kilometer ?? 0,
                'start_time' => now(),
            ]);

            $vehicleRequest->update(['status' => 'in_progress']);

            if ($vehicleRequest->vehicle) {
                $vehicleRequest->vehicle->update(['availability' => 'in_use']);
            }

            $this->notificationService->notifyUser(
                $vehicleRequest->borrower,
                $vehicleRequest->id,
                'trip_started',
                'Trip Started',
                'Your trip has been started by the driver.'
            );

            return $vehicleRequest;
        });
    }

    public function endTripSimple(Request $request, VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($request, $vehicleRequest) {
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

            $this->notificationService->notifyUser(
                $vehicleRequest->borrower,
                $vehicleRequest->id,
                'trip_completed',
                'Trip Completed',
                'Your vehicle request has been completed. Thank you!'
            );

            return $vehicleRequest;
        });
    }

    public function adminStartTrip(Request $request, VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($request, $vehicleRequest) {
            $vehicleRequest->usageRecord()->create([
                'start_km' => $request->start_km,
                'start_time' => $request->start_time,
            ]);

            $vehicleRequest->update(['status' => 'in_progress']);

            $this->notificationService->notifyUser(
                $vehicleRequest->borrower,
                $vehicleRequest->id,
                'trip_started',
                'Trip Started',
                'Your trip has been started by the admin.'
            );

            return $vehicleRequest;
        });
    }

    public function adminEndTrip(Request $request, VehicleRequest $vehicleRequest): VehicleRequest
    {
        return DB::transaction(function () use ($request, $vehicleRequest) {
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
                    'current_kilometer' => $request->end_km
                ]);
            }

            $vehicleRequest->update(['status' => 'completed']);

            $this->notificationService->notifyUser(
                $vehicleRequest->borrower,
                $vehicleRequest->id,
                'trip_completed',
                'Trip Completed',
                'Your vehicle request has been completed by the admin.'
            );

            return $vehicleRequest;
        });
    }
}
