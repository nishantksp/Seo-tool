<?php

namespace App\Services;

use App\Models\Keyword;
use App\Repositories\KeywordRepository;
use App\Repositories\KeywordRankingRepository;

class KeywordRankingService
{
    public function __construct(
        private KeywordRankingRepository $rankings,
        private KeywordRepository $keywords
    ) {
    }

    public function getKeywordOrFail(int $keywordId): Keyword
    {
        return $this->keywords->findOrFail($keywordId);
    }

    public function createRanking(int $keywordId, int $rank): void
    {
        $lastRanking = $this->rankings->getLatestByKeywordId($keywordId);
        $previousRank = $lastRanking ? $lastRanking->rank : null;

        $this->rankings->create([
            'keyword_id' => $keywordId,
            'rank' => $rank,
            'previous_rank' => $previousRank,
            'checked_at' => now(),
        ]);
    }

    //getting keyw
}


