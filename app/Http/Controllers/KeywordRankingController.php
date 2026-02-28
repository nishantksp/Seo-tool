<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use App\Models\KeywordRanking;
use Illuminate\Http\Request;

class KeywordRankingController extends Controller
{
    public function create($keywordId)
    {
        $keyword = Keyword::findOrFail($keywordId);
        return view('admin.rankings.create', compact('keyword'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keyword_id' => 'required',
            'rank' => 'required|integer',
        ]);

        $lastRanking = KeywordRanking::where('keyword_id', $request->keyword_id)
                        ->latest()
                        ->first();

        $previousRank = $lastRanking ? $lastRanking->rank : null;

        KeywordRanking::create([
            'keyword_id' => $request->keyword_id,
            'rank' => $request->rank,
            'previous_rank' => $previousRank,
            'checked_at' => now(),
        ]);

        return redirect('/admin/keywords')->with('success','Ranking Updated');
    }
}