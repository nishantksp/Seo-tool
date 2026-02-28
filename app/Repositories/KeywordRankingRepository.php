<?php

namespace App\Repositories;

use App\Models\KeywordRanking;

class KeywordRankingRepository
{
    public function getLatestByKeywordId(int $keywordId): ?KeywordRanking
    {
        return KeywordRanking::where('keyword_id', $keywordId)->latest()->first();
    }

    public function create(array $data): KeywordRanking
    {
        return KeywordRanking::create($data);
    }
}


