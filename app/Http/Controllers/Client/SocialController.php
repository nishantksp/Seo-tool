<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\SocialPostService;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function __construct(private SocialPostService $service)
    {
    }

    public function index()
    {
        $data = $this->service->listClientPostsWithStats(auth()->id());

        return view('client.social.index', $data);
    }

    public function create()
    {
        $websites = $this->service->listClientWebsites(auth()->id());
        return view('client.social.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required',
            'post_url' => 'required',
            'date' => 'required',
        ]);

        $this->service->createClientPost($request->all());

        return redirect('/client/social')->with('success', 'Post Added');
    }
}


