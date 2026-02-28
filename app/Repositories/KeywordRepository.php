<?php

namespace App\Repositories;

use App\Models\Keyword;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class KeywordRepository
{
    public function getLatestWithWebsiteUserPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Keyword::with('website.user')->latest()->paginate($perPage);
    }

    public function getByWebsiteIdsWithLatestRanking(Collection $websiteIds): Collection
    {
        return Keyword::whereIn('website_id', $websiteIds)
            ->with(['rankings' => function ($q) {
                $q->latest()->limit(1);
            }])
            ->get();
    }

    public function getAllWithWebsiteUser(): Collection
    {
        return Keyword::with('website.user')->get();
    }

    public function create(array $data): Keyword
    {
        return Keyword::create($data);
    }

    public function findOrFail(int $id): Keyword
    {
        return Keyword::findOrFail($id);
    }

    public function update(Keyword $keyword, array $data): Keyword
    {
        $keyword->update($data);
        return $keyword;
    }

    public function deleteById(int $id): void
    {
        Keyword::destroy($id);
    }

    public function countAll(): int
    {
        return Keyword::count();
    }
}


