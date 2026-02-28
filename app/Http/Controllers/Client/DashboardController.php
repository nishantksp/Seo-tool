<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\ClientDashboardService;

class DashboardController extends Controller
{
    public function __construct(private ClientDashboardService $service)
    {
    }

    public function index()
    {
        $user = auth()->user();

        $stats = $this->service->getStats($user->id);

        return view('client.dashboard', $stats);
    }
}


