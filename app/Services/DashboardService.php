<?php

namespace App\Services;

use App\Models\FuelRecord;
use App\Models\UsageRecord;
use App\Models\Vehicle;
use App\Models\VehicleRequest;
use App\Repositories\FuelRepository;
use App\Repositories\ReportRepository;
use App\Repositories\VehicleRequestRepository;
use App\Repositories\VehicleRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function __construct(
        protected VehicleRepository $vehicleRepository,
        protected VehicleRequestRepository $requestRepository,
        protected FuelRepository $fuelRepository,
        protected ReportRepository $reportRepository
    ) {
    }

    public function getDashboardData(): array
    {
        $user = Auth::user();

        $stats = $this->getStatistics();

        $recentRequests = $this->getRecentRequests($user);

        $data = [
            'stats' => $stats,
            'recentRequests' => $recentRequests,
            'vehicles' => $user->role === 'admin' ? Vehicle::all() : [],
        ];

        if ($user->role === 'manager') {
            $data['deptTrips'] = $this->getDepartmentTrips($user);
        }

        return $data;
    }

    public function getStatistics(): array
    {
        return [
            'total_vehicles' => Vehicle::count(),
            'available_vehicles' => Vehicle::where('availability', 'available')->count(),
            'vehicles_in_use' => Vehicle::where('availability', 'in_use')->count(),
            'pending_requests' => $this->requestRepository->getPendingCount(),
            'today_trips' => $this->requestRepository->getTodayTrips(),
            'completed_trips' => $this->requestRepository->getCompletedCount(),
            'total_fuel_cost' => $this->fuelRepository->getTotalFuelCost(),
            'avg_fuel_consumption' => $this->fuelRepository->getAverageFuelConsumption(),
        ];
    }

    protected function getRecentRequests($user)
    {
        return match ($user->role) {
            'admin' => VehicleRequest::with('borrower', 'vehicle')
                ->latest()
                ->take(10)
                ->get(),
            'manager' => $this->getManagerRequests($user),
            'driver' => VehicleRequest::with('borrower', 'vehicle')
                ->where('driver_id', $user->id)
                ->whereIn('status', ['admin_approved', 'in_progress'])
                ->latest()
                ->take(10)
                ->get(),
            default => VehicleRequest::with('vehicle')
                ->where('borrower_id', $user->id)
                ->latest()
                ->take(10)
                ->get(),
        };
    }

    protected function getManagerRequests($user)
    {
        $subordinateIds = $user->subordinates()->pluck('id');

        return VehicleRequest::with('borrower', 'vehicle')
            ->where(function ($q) use ($user, $subordinateIds) {
                $q->where('borrower_id', $user->id)
                    ->orWhereIn('borrower_id', $subordinateIds);
            })
            ->latest()
            ->take(10)
            ->get();
    }

    protected function getDepartmentTrips($user)
    {
        $subordinateIds = $user->subordinates()->pluck('id');

        return VehicleRequest::with('borrower', 'vehicle')
            ->where(function ($q) use ($user, $subordinateIds) {
                $q->where('borrower_id', $user->id)
                    ->orWhereIn('borrower_id', $subordinateIds);
            })
            ->whereIn('status', ['pending', 'manager_approved', 'admin_approved', 'in_progress', 'completed', 'driver_cancelled'])
            ->orderBy('start_datetime', 'desc')
            ->limit(30)
            ->get();
    }

    public function getReportsData(): array
    {
        $usageRecords = $this->reportRepository->getUsageRecords();
        $totalMileage = $this->reportRepository->calculateTotalMileage($usageRecords);
        $totalFuel = $this->reportRepository->calculateTotalFuel($usageRecords);
        $vehicleStats = $this->reportRepository->getVehicleUtilizationStats();

        return [
            'usageRecords' => $usageRecords,
            'totalMileage' => $totalMileage,
            'totalFuel' => $totalFuel,
            'vehicleStats' => $vehicleStats,
        ];
    }
}
