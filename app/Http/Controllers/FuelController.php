<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelRecordStoreRequest;
use App\Http\Requests\FuelRecordUpdateRequest;
use App\Models\FuelAttachment;
use App\Models\FuelRecord;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelController extends Controller
{
    public function index(Request $request)
    {
        $vehicleId = $request->vehicle_id;

        $query = FuelRecord::with('vehicle', 'attachments');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('location', 'like', '%'.$request->search.'%')
                    ->orWhereHas('vehicle', function ($q) use ($request) {
                        $q->where('name', 'like', '%'.$request->search.'%')
                            ->orWhere('plate_number', 'like', '%'.$request->search.'%');
                    });
            });
        }

        if ($request->vehicle_id) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        if ($request->sort === 'oldest') {
            $query->oldest('refuel_date');
        } else {
            $query->latest('refuel_date');
        }

        $vehicles = Vehicle::orderBy('name')->get();

        $fuelRecords = $query->paginate(15)->appends($request->query());

        return view('fuels.index', compact('fuelRecords', 'vehicles', 'vehicleId'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $vehicles = Vehicle::orderBy('name')->get();

        $lastFuelRecord = null;

        if ($request->vehicle_id) {
            $lastFuelRecord = FuelRecord::where('vehicle_id', $request->vehicle_id)
                ->orderBy('refuel_date', 'desc')
                ->first();
        }

        return view('fuels.create', compact('vehicles', 'lastFuelRecord'));
    }

    public function store(FuelRecordStoreRequest $request)
    {
        $validated = $request->validated();

        if (! empty($validated['price_per_liter']) && ! empty($validated['fuel_amount'])) {
            $validated['fuel_cost'] = $validated['price_per_liter'] * $validated['fuel_amount'];
        }

        $fuelRecord = FuelRecord::create($validated);

        if ($request->filled('kilometer')) {
            $vehicle = Vehicle::find($validated['vehicle_id']);
            if ($vehicle) {
                $vehicle->current_kilometer = $request->input('kilometer');
                $vehicle->save();
            }
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->store('fuel-attachments', 'public');

                FuelAttachment::create([
                    'fuel_record_id' => $fuelRecord->id,
                    'file_path' => $path,
                    'file_name' => $filename,
                    'file_type' => $file->getMimeType(),
                ]);
            }
        }

        return redirect()->route('fuels.index')->with('success', 'Fuel record added successfully.');
    }

    public function edit($fuelRecord)
    {
        $vehicles = Vehicle::orderBy('name')->get();
        $fuel = FuelRecord::find($fuelRecord);

        if (! $fuel) {
            abort(404, 'Fuel record not found');
        }

        return view('fuels.edit', compact('fuel', 'vehicles'));
    }

    public function update(FuelRecordUpdateRequest $request, $fuelRecord)
    {
        $fuel = FuelRecord::findOrFail($fuelRecord);

        $data = $request->validated();

        if ($request->price_per_liter && $request->fuel_amount) {
            $data['fuel_cost'] = $request->price_per_liter * $request->fuel_amount;
        }

        $fuel->update($data);

        $vehicle = Vehicle::find($request->vehicle_id);
        $vehicle->current_kilometer = $request->kilometer;
        $vehicle->save();

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->store('fuel-attachments', 'public');

                FuelAttachment::create([
                    'fuel_record_id' => $fuel->id,
                    'file_path' => $path,
                    'file_name' => $filename,
                    'file_type' => $file->getMimeType(),
                ]);
            }
        }

        return redirect()->route('fuels.index')->with('success', 'Fuel record updated successfully.');
    }

    public function destroy(Request $request, $fuelRecord)
    {
        $fuel = FuelRecord::find($fuelRecord);
        if (! $fuel) {
            abort(404);
        }

        $fuel->delete();

        return redirect()->route('fuels.index')->with('success', 'Fuel record deleted successfully.');
    }
}
