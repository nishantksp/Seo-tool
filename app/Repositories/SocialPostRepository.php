<?php

namespace App\Repositories;

use App\Models\SocialPost;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SocialPostRepository
{
    public function getLatestWithWebsiteUserPaginated(?string $platform, int $perPage = 10): LengthAwarePaginator
    {
        $query = SocialPost::with('website.user')->latest();

        if ($platform) {
            $query->where('platform', $platform);
        }

        return $query->paginate($perPage);
    }

    public function getByWebsiteIdsLatest(Collection $websiteIds): Collection
    {
        return SocialPost::whereIn('website_id', $websiteIds)->latest()->get();
    }

    public function create(array $data): SocialPost
    {
        return SocialPost::create($data);
    }

    public function findOrFail(int $id): SocialPost
    {
        return SocialPost::findOrFail($id);
    }

    public function update(SocialPost $post, array $data): SocialPost
    {
        $post->update($data);
        return $post;
    }

    public function deleteById(int $id): void
    {
        SocialPost::destroy($id);
    }
}


