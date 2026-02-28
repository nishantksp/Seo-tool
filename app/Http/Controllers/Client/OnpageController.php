<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\OnpageReport;
use App\Models\Website;

class OnpageController extends Controller
{
    public function index()
{
    $websiteIds = \App\Models\Website::where('user_id', auth()->id())->pluck('id');

    $reports = \App\Models\OnpageReport::whereIn('website_id',$websiteIds)
                ->latest()
                ->get();

    return view('client.onpage', compact('reports'));
}
}