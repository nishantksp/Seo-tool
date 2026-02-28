<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\BacklinkService;

class BacklinkController extends Controller
{
    public function __construct(private BacklinkService $service)
    {
    }

    public function index()
    {
        $data = $this->service->listClientBacklinksWithStats(auth()->id());

        return view('client.backlinks', $data);
    }
}


