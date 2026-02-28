<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\Keyword;
use App\Models\Backlink;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $websites = Website::where('user_id',$user->id)->pluck('id');

        return view('client.dashboard', [
            'keywords' => Keyword::whereIn('website_id',$websites)->count(),
            'backlinks' => Backlink::whereIn('website_id',$websites)->count(),
        ]);
    }
}