<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Website;

class WebsiteController extends Controller
{
    public function index()
{
    $websites = auth()->user()->websites;
    return view('client.websites', compact('websites'));
}
}
