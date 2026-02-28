<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OnpageReport;
use App\Models\Website;
use Illuminate\Http\Request;

class OnpageReportController extends Controller
{
    public function index()
    {
        $reports = OnpageReport::with('website.user')->latest()->paginate(10);
        return view('admin.onpage.index', compact('reports'));
    }

    public function create()
    {
        $websites = Website::with('user')->get();
        return view('admin.onpage.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $report = new OnpageReport($request->all());

        $report->seo_score = $report->calculateScore();
        $report->checked_at = now();

        $report->save();

        return redirect('/admin/onpage')->with('success','Report Added');
    }

    public function destroy($id)
    {
        OnpageReport::destroy($id);
        return back()->with('success','Deleted');
    }
}