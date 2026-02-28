<?php

namespace App\Repositories;

use App\Models\Backlink;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BacklinkRepository
{
    public function getLatestWithWebsiteUserPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Backlink::with('website.user')->latest()->paginate($perPage);
    }

    public function getByWebsiteIds(Collection $websiteIds): Collection
    {
        return Backlink::whereIn('website_id', $websiteIds)->get();
    }

    public function create(array $data): Backlink
    {
        return Backlink::create($data);
    }

    public function findOrFail(int $id): Backlink
    {
        return Backlink::findOrFail($id);
    }

    public function update(Backlink $backlink, array $data): Backlink
    {
        $backlink->update($data);
        return $backlink;
    }

    public function deleteById(int $id): void
    {
        Backlink::destroy($id);
    }
}


