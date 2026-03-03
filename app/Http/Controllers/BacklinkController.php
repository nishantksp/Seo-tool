<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BacklinkStoreRequest;
use App\Http\Requests\BacklinkUpdateRequest;
use App\Services\BacklinkService;
use App\Services\WebsiteService;
use App\Services\KeywordService;
use Illuminate\Http\Request;

class BacklinkController extends Controller
{
    /**
     * Inject services for backlink CRUD and related website/keyword lookups.
     */
    public function __construct(private BacklinkService $service,
    private WebsiteService $websiteService,
    private KeywordService $keywordService)
    {
    }

    /**
     * List backlinks for admin with optional website filter.
     */
    public function index(Request $request)
    {   
        $selectedId= $request->website_id;
        $allWebsites=$this->websiteService->listDropDownWebsites();
        $websites = $this->websiteService->listWebsitesWithKeywords($selectedId);
        $keywords=$this->keywordService->getKeywordsByWebsiteId($selectedId);
        $backlinks = $this->service->listAdminBacklinks();
        return view('admin.backlinks.index', compact('backlinks','websites','allWebsites','keywords'));
    }

    /**
     * Show the create backlink form.
     */
    public function create()
    {
        $websites = $this->service->listAdminWebsites();
        return view('admin.backlinks.create', compact('websites'));
    }

    /**
     * Store a new backlink using validated input.
     */
    public function store(BacklinkStoreRequest $request)
    {
        // Store validated data to prevent accidental mass assignment.
        $this->service->createBacklink($request->validated());

        return redirect('/admin/backlinks')->with('success','Backlink Added');
    }

    /**
     * Show the edit backlink form.
     */
    public function edit($id)
    {
        $backlink = $this->service->getBacklinkForEdit($id);
        $websites = $this->service->listAdminWebsites();

        return view('admin.backlinks.edit', compact('backlink','websites'));
    }

    /**
     * Update an existing backlink using validated input.
     */
    public function update(BacklinkUpdateRequest $request, $id)
    {
        $backlink = $this->service->getBacklinkForEdit($id);
        $this->service->updateBacklink($backlink, $request->validated());

        return redirect('/admin/backlinks')->with('success','Backlink Updated');
    }

    /**
     * Delete a backlink by id.
     */
    public function destroy($id)
    {
        $this->service->deleteBacklink($id);
        return back()->with('success','Backlink Deleted');
    }
}
