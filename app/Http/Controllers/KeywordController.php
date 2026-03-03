<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeywordAssignmentStoreRequest;
use App\Http\Requests\KeywordAssignmentUpdateRequest;
use App\Services\KeywordService;

class KeywordController extends Controller
{
    /**
     * Inject the keyword service.
     */
    public function __construct(private KeywordService $service)
    {
    }

    /**
     * List admin keyword assignments.
     */
    public function index()
    {
        $keywords = $this->service->listAdminKeywords();
        return view('admin.keywords.index', compact('keywords'));
    }

    /**
     * Show create keyword assignment form.
     */
    public function create()
    {
        $websites = $this->service->listAdminWebsites();
        return view('admin.keywords.create', compact('websites'));
    }

    /**
     * Store a keyword assignment.
     */
    public function store(KeywordAssignmentStoreRequest $request)
    {
        // Store as keyword assignment to support shared keywords across websites.
        $this->service->createKeywordAssignment($request->validated());

        return redirect('/admin/keywords')->with('success','Keyword Added');
    }

    /**
     * Show edit form for a keyword assignment.
     */
    public function edit($id)
    {
        $keyword = $this->service->getAssignmentForEdit($id);
        $websites = $this->service->listAdminWebsites();

        return view('admin.keywords.edit', compact('keyword','websites'));
    }

    /**
     * Update a keyword assignment.
     */
    public function update(KeywordAssignmentUpdateRequest $request, $id)
    {
        $keyword = $this->service->getAssignmentForEdit($id);
        $this->service->updateAssignment($keyword, $request->validated());

        return redirect('/admin/keywords')->with('success','Keyword Updated');
    }

    /**
     * Delete a keyword assignment.
     */
    public function destroy($id)
    {
        $this->service->deleteAssignment($id);
        return back()->with('success','Keyword Deleted');
    }

    
}
