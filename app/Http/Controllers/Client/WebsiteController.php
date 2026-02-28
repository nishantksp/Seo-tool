<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\WebsiteService;

class WebsiteController extends Controller
{
    public function __construct(private WebsiteService $service)
    {
    }

    public function index()
    {
        $websites = $this->service->listClientWebsites(auth()->id());
        return view('client.websites', compact('websites'));
    }
}


