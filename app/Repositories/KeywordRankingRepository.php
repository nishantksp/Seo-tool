<?php

namespace App\Repositories;

use App\Models\KeywordRanking;

class KeywordRankingRepository
{
    /**
     * Get the latest ranking for an assignment (optionally filtered).
     */
    public function getLatestByAssignment(
        int $assignmentId,
        ?string $searchEngine = null,
        ?string $location = null,
        ?string $deviceType = null
    ): ?KeywordRanking
    {
        return KeywordRanking::where('keyword_assignment_id', $assignmentId)
            ->when($searchEngine, fn ($q) => $q->where('search_engine', $searchEngine))
            ->when($location, fn ($q) => $q->where('location', $location))
            ->when($deviceType, fn ($q) => $q->where('device_type', $deviceType))
            ->latest()
            ->first();
    }

    /**
     * Create a new ranking record.
     */
    public function create(array $data): KeywordRanking
    {
        return KeywordRanking::create($data);
    }
}
