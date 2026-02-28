<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Backlink;
use App\Models\Website;
use Illuminate\Http\Request;

class BacklinkController extends Controller
{
    public function index()
    {
        $backlinks = Backlink::with('website.user')->latest()->paginate(10);
        return view('admin.backlinks.index', compact('backlinks'));
    }

    public function create()
    {
        $websites = Website::with('user')->get();
        return view('admin.backlinks.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required',
            'source_url' => 'required',
            'link_type' => 'required',
            'status' => 'required',
        ]);

        Backlink::create($request->all());

        return redirect('/admin/backlinks')->with('success','Backlink Added');
    }

    public function edit($id)
    {
        $backlink = Backlink::findOrFail($id);
        $websites = Website::with('user')->get();

        return view('admin.backlinks.edit', compact('backlink','websites'));
    }

    public function update(Request $request, $id)
    {
        $backlink = Backlink::findOrFail($id);
        $backlink->update($request->all());

        return redirect('/admin/backlinks')->with('success','Backlink Updated');
    }

    public function destroy($id)
    {
        Backlink::destroy($id);
        return back()->with('success','Backlink Deleted');
    }
}