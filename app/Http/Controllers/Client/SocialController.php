<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SocialPost;
use App\Models\Website;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $websiteIds = Website::where('user_id', auth()->id())->pluck('id');

        $posts = SocialPost::whereIn('website_id', $websiteIds)
            ->latest()
            ->get();

        $totalPosts = $posts->count();
        $totalClicks = $posts->sum('clicks');
        $totalEngagement = $posts->sum('engagement');

        return view('client.social.index', compact(
            'posts',
            'totalPosts',
            'totalClicks',
            'totalEngagement'
        ));
    }

    public function create()
    {
        $websites = Website::where('user_id', auth()->id())->get();
        return view('client.social.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required',
            'post_url' => 'required',
            'date' => 'required',
        ]);

        SocialPost::create($request->all());

        return redirect('/client/social')->with('success', 'Post Added');
    }
}