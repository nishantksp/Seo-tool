<?php

namespace App\Services;

use App\Models\KeywordAssignment;
use App\Repositories\KeywordAssignmentRepository;
use App\Repositories\KeywordRankingRepository;

class KeywordRankingService
{
    /**
     * Ranking service coordinates assignment lookups and ranking history.
     */
    public function __construct(
        private KeywordRankingRepository $rankings,
        private KeywordAssignmentRepository $assignments
    ) {
    }

    /**
     * Fetch a keyword assignment for rank updates.
     */
    public function getAssignmentOrFail(int $assignmentId): KeywordAssignment
    {
        return $this->assignments->findOrFail($assignmentId);
    }

    /**
     * Store a new ranking record with history metadata.
     */
    public function createRanking(int $assignmentId, int $rank, ?string $searchEngine, ?string $location, ?string $deviceType): void
    {
        $lastRanking = $this->rankings->getLatestByAssignment($assignmentId, $searchEngine, $location, $deviceType);
        $previousRank = $lastRanking ? $lastRanking->rank : null;

        $this->rankings->create([
            'keyword_assignment_id' => $assignmentId,
            'rank' => $rank,
            'previous_rank' => $previousRank,
            'checked_at' => now(),
            'search_engine' => $searchEngine ?? 'google',
            'location' => $location,
            'device_type' => $deviceType ?? 'desktop',
        ]);
    }
}
