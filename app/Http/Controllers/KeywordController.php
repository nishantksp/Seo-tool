<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use App\Models\Website;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index()
    {
        $keywords = Keyword::with('website.user')->latest()->paginate(10);
        return view('admin.keywords.index', compact('keywords'));
    }

    public function create()
    {
        $websites = Website::with('user')->get();
        return view('admin.keywords.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required',
            'keyword' => 'required',
        ]);

        Keyword::create($request->all());

        return redirect('/admin/keywords')->with('success','Keyword Added');
    }

    public function edit($id)
    {
        $keyword = Keyword::findOrFail($id);
        $websites = Website::with('user')->get();

        return view('admin.keywords.edit', compact('keyword','websites'));
    }

    public function update(Request $request, $id)
    {
        $keyword = Keyword::findOrFail($id);
        $keyword->update($request->all());

        return redirect('/admin/keywords')->with('success','Keyword Updated');
    }

    public function destroy($id)
    {
        Keyword::destroy($id);
        return back()->with('success','Keyword Deleted');
    }
}