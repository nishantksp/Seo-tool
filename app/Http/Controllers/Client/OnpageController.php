<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\OnpageReportService;

class OnpageController extends Controller
{
    public function __construct(private OnpageReportService $service)
    {
    }

    public function index()
    {
        $reports = $this->service->listClientReports(auth()->id());

        return view('client.onpage', compact('reports'));
    }
}


