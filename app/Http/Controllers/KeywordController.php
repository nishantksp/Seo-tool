<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\KeywordService;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function __construct(private KeywordService $service)
    {
    }

    public function index()
    {
        $keywords = $this->service->listAdminKeywords();
        return view('admin.keywords.index', compact('keywords'));
    }

    public function create()
    {
        $websites = $this->service->listAdminWebsites();
        return view('admin.keywords.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'website_id' => 'required',
            'keyword' => 'required',
        ]);

        $this->service->createKeyword($request->all());

        return redirect('/admin/keywords')->with('success','Keyword Added');
    }

    public function edit($id)
    {
        $keyword = $this->service->getKeywordForEdit($id);
        $websites = $this->service->listAdminWebsites();

        return view('admin.keywords.edit', compact('keyword','websites'));
    }

    public function update(Request $request, $id)
    {
        $keyword = $this->service->getKeywordForEdit($id);
        $this->service->updateKeyword($keyword, $request->all());

        return redirect('/admin/keywords')->with('success','Keyword Updated');
    }

    public function destroy($id)
    {
        $this->service->deleteKeyword($id);
        return back()->with('success','Keyword Deleted');
    }
}


