<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Vehicle::query();

        if ($request->has('available')) {
            $query->where('availability', 'available');
        }

        return VehicleResource::collection($query->get());
    }

    public function store(VehicleStoreRequest $request): JsonResponse
    {
        $vehicle = Vehicle::create($request->validated());

        return response()->json(new VehicleResource($vehicle), 201);
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        return response()->json(new VehicleResource($vehicle->load('driver')));
    }

    public function update(VehicleUpdateRequest $request, Vehicle $vehicle): JsonResponse
    {
        $vehicle->update($request->validated());

        return response()->json(new VehicleResource($vehicle));
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        $vehicle->delete();

        return response()->json(['message' => 'Vehicle deleted']);
    }
}
