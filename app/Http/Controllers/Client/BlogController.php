<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $websiteIds = Website::where('user_id', auth()->id())->pluck('id');
        $blogs = Blog::whereIn('website_id', $websiteIds)->latest()->get();

        return view('client.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $websites = Website::where('user_id', auth()->id())->get();
        return view('client.blogs.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $slug = Str::slug($request->title);

        Blog::create([
            'website_id' => $request->website_id,
            'title' => $request->title,
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'content' => $request->content,
            'status' => $request->status ?? 'draft',
        ]);

        return redirect('/client/blogs')->with('success','Blog Created');
    }
}