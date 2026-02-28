<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OnpageReportService;
use Illuminate\Http\Request;

class OnpageReportController extends Controller
{
    public function __construct(private OnpageReportService $service)
    {
    }

    public function index()
    {
        $reports = $this->service->listAdminReports();
        return view('admin.onpage.index', compact('reports'));
    }

    public function create()
    {
        $websites = $this->service->listAdminWebsites();
        return view('admin.onpage.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $this->service->createReport($request->all());

        return redirect('/admin/onpage')->with('success','Report Added');
    }

    public function destroy($id)
    {
        $this->service->deleteReport($id);
        return back()->with('success','Deleted');
    }
}


