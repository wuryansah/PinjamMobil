<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequestStoreRequest;
use App\Http\Requests\VehicleRequestUpdateRequest;
use App\Http\Resources\VehicleRequestResource;
use App\Models\Notification;
use App\Models\User;
use App\Models\VehicleRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class VehicleRequestController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $user = Auth::user();
        $query = VehicleRequest::query()->with('borrower', 'vehicle', 'driver');

        if ($user->role === 'admin') {
        } elseif ($user->role === 'manager') {
            $subordinateIds = $user->subordinates()->pluck('id');
            $query->whereIn('status', ['pending'])->whereIn('borrower_id', $subordinateIds);
        } elseif ($user->role === 'driver') {
            $query->where('driver_id', $user->id);
        } else {
            $query->where('borrower_id', $user->id);
        }

        return VehicleRequestResource::collection($query->get());
    }

    public function store(VehicleRequestStoreRequest $request): JsonResponse
    {
        $user = Auth::user();

        $vehicleRequest = VehicleRequest::create([
            'borrower_id' => $user->id,
            ...$request->validated(),
            'status' => 'pending',
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

        return response()->json(new VehicleRequestResource($vehicleRequest), 201);
    }

    public function show(VehicleRequest $vehicleRequest): JsonResponse
    {
        return response()->json(new VehicleRequestResource(
            $vehicleRequest->load('borrower', 'vehicle', 'driver', 'usageRecord')
        ));
    }

    public function update(VehicleRequestUpdateRequest $request, VehicleRequest $vehicleRequest): JsonResponse
    {
        $vehicleRequest->update($request->validated());

        return response()->json(new VehicleRequestResource($vehicleRequest));
    }

    public function destroy(VehicleRequest $vehicleRequest): JsonResponse
    {
        $vehicleRequest->delete();

        return response()->json(['message' => 'Request deleted']);
    }
}
