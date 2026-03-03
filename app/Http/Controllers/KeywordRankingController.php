<?php

namespace App\Http\Controllers;

use App\Services\KeywordRankingService;
use App\Http\Requests\KeywordRankingStoreRequest;

class KeywordRankingController extends Controller
{
    /**
     * Inject ranking service.
     */
    public function __construct(private KeywordRankingService $service)
    {
    }

    /**
     * Show the ranking update form for a keyword assignment.
     */
    public function create($keywordId)
    {
        $assignment = $this->service->getAssignmentOrFail((int) $keywordId);
        return view('admin.rankings.create', compact('assignment'));
    }

    /**
     * Store a new ranking record.
     */
    public function store(KeywordRankingStoreRequest $request)
    {
        $data = $request->validated();

        // Keep ranking history per engine/location/device for accurate trend analysis.
        $this->service->createRanking(
            (int) $data['keyword_assignment_id'],
            (int) $data['rank'],
            $data['search_engine'] ?? null,
            $data['location'] ?? null,
            $data['device_type'] ?? null
        );

        return redirect('/admin/keywords')->with('success','Ranking Updated');
    }
}
