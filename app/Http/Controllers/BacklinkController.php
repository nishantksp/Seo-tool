<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BacklinkService;
use App\Services\WebsiteService;
use App\Services\KeywordService;
use Illuminate\Http\Request;

class BacklinkController extends Controller
{
    public function __construct(private BacklinkService $service,
    private WebsiteService $websiteService,
    private KeywordService $keywordService)
    {
    }

    public function index(Request $request)
    {   
        $selectedId= $request->website_id;
        $allWebsites=$this->websiteService->listDropDownWebsites();
        $websites = $this->websiteService->listWebsitesWithKeywords($selectedId);
        $keywords=$this->keywordService->getKeywordsByWebsiteId($selectedId);
        $backlinks = $this->service->listAdminBacklinks();
        return view('admin.backlinks.index', compact('backlinks','websites','allWebsites','keywords'));
    }

    public function create()
    {
        $websites = $this->service->listAdminWebsites();
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

        $this->service->createBacklink($request->all());

        return redirect('/admin/backlinks')->with('success','Backlink Added');
    }

    public function edit($id)
    {
        $backlink = $this->service->getBacklinkForEdit($id);
        $websites = $this->service->listAdminWebsites();

        return view('admin.backlinks.edit', compact('backlink','websites'));
    }

    public function update(Request $request, $id)
    {
        $backlink = $this->service->getBacklinkForEdit($id);
        $this->service->updateBacklink($backlink, $request->all());

        return redirect('/admin/backlinks')->with('success','Backlink Updated');
    }

    public function destroy($id)
    {
        $this->service->deleteBacklink($id);
        return back()->with('success','Backlink Deleted');
    }
}


