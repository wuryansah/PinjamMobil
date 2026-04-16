<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'borrower_id' => $this->borrower_id,
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'destination' => $this->destination,
            'purpose' => $this->purpose,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'status' => $this->status,
            'supervisor_notes' => $this->supervisor_notes,
            'manager_notes' => $this->manager_notes,
            'admin_notes' => $this->admin_notes,
            'approved_by' => $this->approved_by,
            'assigned_by' => $this->assigned_by,
            'borrower' => $this->whenLoaded('borrower', function () {
                return [
                    'id' => $this->borrower->id,
                    'name' => $this->borrower->name,
                    'email' => $this->borrower->email,
                ];
            }),
            'vehicle' => $this->whenLoaded('vehicle', function () {
                return [
                    'id' => $this->vehicle->id,
                    'name' => $this->vehicle->name,
                    'plate_number' => $this->vehicle->plate_number,
                ];
            }),
            'driver' => $this->whenLoaded('driver', function () {
                return [
                    'id' => $this->driver->id,
                    'name' => $this->driver->name,
                    'email' => $this->driver->email,
                ];
            }),
            'usage_record' => $this->whenLoaded('usageRecord', function () {
                return new UsageRecordResource($this->usageRecord);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
