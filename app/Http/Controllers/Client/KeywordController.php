<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use App\Models\Website;

class KeywordController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $websiteIds = Website::where('user_id', $user->id)->pluck('id');

        $keywords = Keyword::whereIn('website_id', $websiteIds)
            ->with(['rankings' => function ($q) {
                $q->latest()->limit(1);
            }])
            ->get();

        return view('client.keywords', compact('keywords'));
    }
}