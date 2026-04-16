<?php

namespace App\Http\Controllers;

use App\Models\FuelRecord;
use App\Models\Vehicle;
use App\Models\VehicleRequest;
use App\Repositories\FuelRepository;
use App\Repositories\ReportRepository;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(
        protected ReportRepository $reportRepository,
        protected FuelRepository $fuelRepository
    ) {
    }

    public function index(Request $request)
    {
        $requests = $this->reportRepository->getCompletedTripsWithStats();
        $totalMileage = $this->reportRepository->calculateTotalMileage($requests);
        $totalFuel = $this->fuelRepository->getTotalFuelAmount();
        $totalCost = $this->fuelRepository->getTotalFuelCost();

        return view('reports.index', compact('requests', 'totalMileage', 'totalFuel', 'totalCost'));
    }

    public function tripHistory(Request $request)
    {
        $requests = $this->reportRepository->filterByDateRange(
            $request->start_date,
            $request->end_date,
            $request->vehicle_id
        );

        $totalMileage = $this->reportRepository->calculateTotalMileage($requests);

        $fuelQuery = FuelRecord::query();
        if ($request->start_date) {
            $fuelQuery->whereDate('refuel_date', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $fuelQuery->whereDate('refuel_date', '<=', $request->end_date);
        }

        $totalFuel = (clone $fuelQuery)->sum('fuel_amount');
        $totalCost = (clone $fuelQuery)->sum('fuel_cost');

        $vehicles = Vehicle::orderBy('name')->get();

        if ($request->has('export') && $request->export === 'pdf') {
            $pdf = PDF::loadView('reports.pdf', compact('requests', 'totalMileage', 'totalFuel', 'totalCost', 'request'));

            return $pdf->download('report-'.date('Y-m-d').'.pdf');
        }

        return view('reports.trip-history', compact('requests', 'totalMileage', 'totalFuel', 'totalCost', 'vehicles'));
    }

    public function fuelReport(Request $request)
    {
        $fuelRecords = $this->fuelRepository->filterByDateRange(
            $request->start_date,
            $request->end_date,
            $request->vehicle_id
        );

        $totalFuelAmount = $fuelRecords->sum('fuel_amount');
        $totalFuelCost = $fuelRecords->sum('fuel_cost');
        $avgConsumption = $fuelRecords->filter(fn ($r) => $r->fuel_consumption !== null)->avg('fuel_consumption');

        $vehicles = Vehicle::orderBy('name')->get();

        if ($request->has('export') && $request->export === 'pdf') {
            $pdf = PDF::loadView('reports.fuel-pdf', compact('fuelRecords', 'totalFuelAmount', 'totalFuelCost', 'avgConsumption', 'request'));

            return $pdf->download('fuel-report-'.date('Y-m-d').'.pdf');
        }

        return view('reports.fuel', compact('fuelRecords', 'totalFuelAmount', 'totalFuelCost', 'avgConsumption', 'vehicles'));
    }
}
