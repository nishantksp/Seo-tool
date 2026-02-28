<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\KeywordRankingService;
use Illuminate\Http\Request;

class KeywordRankingController extends Controller
{
    public function __construct(private KeywordRankingService $service)
    {
    }

    public function create($keywordId)
    {
        $keyword = $this->service->getKeywordOrFail((int) $keywordId);
        return view('admin.rankings.create', compact('keyword'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keyword_id' => 'required',
            'rank' => 'required|integer',
        ]);

        $this->service->createRanking((int) $request->keyword_id, (int) $request->rank);

        return redirect('/admin/keywords')->with('success','Ranking Updated');
    }
}


