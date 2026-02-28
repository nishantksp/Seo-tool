<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Backlink;
use App\Models\Website;

class BacklinkController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $websiteIds = Website::where('user_id', $user->id)->pluck('id');

        $backlinks = Backlink::whereIn('website_id', $websiteIds)->get();

        $total = $backlinks->count();
        $active = $backlinks->where('status', 'active')->count();
        $lost = $backlinks->where('status', 'lost')->count();
        $dofollow = $backlinks->where('link_type', 'dofollow')->count();

        return view('client.backlinks', compact(
            'backlinks',
            'total',
            'active',
            'lost',
            'dofollow'
        ));
    }
}