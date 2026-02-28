<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(private BlogService $service)
    {
    }

    public function index()
    {
        $blogs = $this->service->listClientBlogs(auth()->id());

        return view('client.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $websites = $this->service->listClientWebsites(auth()->id());
        return view('client.blogs.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $this->service->createClientBlog($request->all());

        return redirect('/client/blogs')->with('success','Blog Created');
    }
}


