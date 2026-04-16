<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct(protected VehicleRepository $repository)
    {
    }

    public function index(Request $request)
    {
        $vehicles = $this->repository->paginated($request);

        return view('vehicles.index', compact('vehicles'));
    }

    public function store(VehicleStoreRequest $request)
    {
        $this->repository->create($request->validated());

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $this->repository->update($vehicle, $request->validated());

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->repository->delete($vehicle);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function available()
    {
        return response()->json($this->repository->getAvailableVehicles());
    }

    public function getDrivers()
    {
        return response()->json($this->repository->getDrivers());
    }
}
