<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SocialPost;
use App\Models\Website;
use Illuminate\Http\Request;

class SocialPostController extends Controller
{
    public function index(Request $request)
    {
        $query = SocialPost::with('website.user')->latest();

        if ($request->platform) {
            $query->where('platform', $request->platform);
        }

        $posts = $query->paginate(10);

        return view('admin.social.index', compact('posts'));
    }

    public function create()
    {
        $websites = Website::with('user')->get();
        return view('admin.social.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required',
            'platform' => 'required',
            'post_url' => 'required',
            'date' => 'required',
        ]);

        SocialPost::create($request->all());

        return redirect('/admin/social')->with('success','Post Added');
    }

    public function edit($id)
    {
        $post = SocialPost::findOrFail($id);
        $websites = Website::with('user')->get();

        return view('admin.social.edit', compact('post','websites'));
    }

    public function update(Request $request, $id)
    {
        $post = SocialPost::findOrFail($id);
        $post->update($request->all());

        return redirect('/admin/social')->with('success','Updated');
    }

    public function destroy($id)
    {
        SocialPost::destroy($id);
        return back()->with('success','Deleted');
    }
}