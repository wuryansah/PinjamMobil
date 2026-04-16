<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $service)
    {
    }

    public function index()
    {
        $data = $this->service->getDashboardData();

        return view('dashboard', $data);
    }

    public function reports()
    {
        $data = $this->service->getReportsData();

        return view('reports.index', $data);
    }
}
