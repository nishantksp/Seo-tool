<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Collection;

class BlogRepository
{
    public function getByWebsiteIdsLatest(Collection $websiteIds): Collection
    {
        return Blog::whereIn('website_id', $websiteIds)->latest()->get();
    }

    public function create(array $data): Blog
    {
        return Blog::create($data);
    }
}


