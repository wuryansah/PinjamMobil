<?php

namespace App\Repositories;

use App\Models\FuelRecord;
use App\Models\UsageRecord;
use App\Models\Vehicle;
use App\Models\VehicleRequest;
use Illuminate\Database\Eloquent\Collection;

class ReportRepository
{
    public function getCompletedTripsWithStats(): Collection
    {
        return VehicleRequest::with('borrower', 'vehicle', 'driver', 'usageRecord')
            ->where('status', 'completed')
            ->orderBy('end_datetime', 'desc')
            ->get();
    }

    public function filterByDateRange(?string $startDate = null, ?string $endDate = null, ?int $vehicleId = null): Collection
    {
        $query = VehicleRequest::with('borrower', 'vehicle', 'driver', 'usageRecord')
            ->where('status', 'completed');

        if ($startDate) {
            $query->whereDate('start_datetime', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('end_datetime', '<=', $endDate);
        }

        if ($vehicleId) {
            $query->where('vehicle_id', $vehicleId);
        }

        return $query->orderBy('end_datetime', 'desc')->get();
    }

    public function calculateTotalMileage(Collection $trips): float
    {
        return $trips->sum(function ($trip) {
            if ($trip->usageRecord && $trip->usageRecord->end_km && $trip->usageRecord->start_km) {
                return $trip->usageRecord->end_km - $trip->usageRecord->start_km;
            }
            return 0;
        });
    }

    public function getTotalFuelAmount(): float
    {
        return FuelRecord::sum('fuel_amount');
    }

    public function getTotalFuelCost(): float
    {
        return FuelRecord::sum('fuel_cost');
    }

    public function getVehicleUtilizationStats(): Collection
    {
        return Vehicle::withCount(['requests' => function ($query) {
            $query->where('status', 'completed');
        }])->get();
    }

    public function getUsageRecords(): Collection
    {
        return UsageRecord::with('request.borrower', 'request.vehicle')
            ->whereHas('request', function ($query) {
                $query->where('status', 'completed');
            })
            ->latest()
            ->get();
    }

    public function calculateTotalFuel(Collection $usageRecords): float
    {
        return $usageRecords->sum('fuel_used');
    }
}
