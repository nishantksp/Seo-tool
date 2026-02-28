<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::with('user')->latest()->get();
        return view('admin.websites.index', compact('websites'));
    }

    public function create()
    {
        $clients = User::where('role','client')->get();
        return view('admin.websites.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'domain' => 'required',
            'user_id' => 'required',
        ]);

        Website::create($request->all());

        return redirect('/admin/websites')->with('success','Website Added');
    }
}