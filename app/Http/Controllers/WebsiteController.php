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
    $websites = Website::with(['user','keywords'])->latest()->get();
    return view('admin.websites.index', compact('websites'));
}

  public function create()
{
    $clients = User::where('role','client')->get();

    $countries = ['India','United Kingdom','United States','Canada','Australia'];
    $niches = ['Digital Marketing','E-commerce','Healthcare','Education','Real Estate','Finance'];

    return view('admin.websites.create', compact('clients','countries','niches'));
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
    public function edit($id)
{
    $website = Website::findOrFail($id);
    $clients = User::where('role','client')->get();

    $countries = ['India','United Kingdom','United States','Canada','Australia'];
    $niches = ['Digital Marketing','E-commerce','Healthcare','Education','Real Estate','Finance'];

    return view('admin.websites.edit', compact('website','clients','countries','niches'));
}
public function update(Request $request, $id)
{
    $website = Website::findOrFail($id);

    $website->update([
        'user_id' => $request->user_id,
        'domain' => $request->domain,
        'country' => $request->country,
        'niche' => $request->niche,
    ]);

    return redirect('/admin/websites')->with('success','Website Updated');
}
public function destroy($id)
{
    $website = Website::findOrFail($id);
    $website->delete();

    return redirect('/admin/websites')->with('success','Website Deleted');
}
}