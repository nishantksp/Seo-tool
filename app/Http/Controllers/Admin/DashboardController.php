<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;

class DashboardController extends Controller
{
    public function __construct(private AdminDashboardService $service)
    {
    }

    public function index()
    {
        return view('admin.dashboard', $this->service->getStats());
    }
}


