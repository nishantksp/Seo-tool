<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;
use App\Services\WebsiteService;

class DashboardController extends Controller
{
    public function __construct(private AdminDashboardService $service,
    private WebsiteService $websiteService)
    {
    }

    public function index()
    {
        $websiteStats= $this->websiteService->getWebsiteStats();
        $getAdminStats=$this->service->getStats();
        return view('admin.dashboard', compact('websiteStats','getAdminStats'));
    }
}


