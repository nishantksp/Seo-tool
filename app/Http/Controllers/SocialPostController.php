<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SocialPostService;
use Illuminate\Http\Request;

class SocialPostController extends Controller
{
    public function __construct(private SocialPostService $service)
    {
    }

    public function index(Request $request)
    {
        $posts = $this->service->listAdminPosts($request->platform);

        return view('admin.social.index', compact('posts'));
    }

    public function create()
    {
        $websites = $this->service->listAdminWebsites();
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

        $this->service->createAdminPost($request->all());

        return redirect('/admin/social')->with('success','Post Added');
    }

    public function edit($id)
    {
        $post = $this->service->getAdminPostForEdit($id);
        $websites = $this->service->listAdminWebsites();

        return view('admin.social.edit', compact('post','websites'));
    }

    public function update(Request $request, $id)
    {
        $post = $this->service->getAdminPostForEdit($id);
        $this->service->updateAdminPost($post, $request->all());

        return redirect('/admin/social')->with('success','Updated');
    }

    public function destroy($id)
    {
        $this->service->deleteAdminPost($id);
        return back()->with('success','Deleted');
    }
}


