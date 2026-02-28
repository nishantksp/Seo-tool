<?php

namespace App\Services;

use App\Repositories\BlogRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Str;

class BlogService
{
    public function __construct(
        private BlogRepository $blogs,
        private WebsiteRepository $websites
    ) {
    }

    public function listClientBlogs(int $userId)
    {
        $websiteIds = $this->websites->getIdsByUserId($userId);
        return $this->blogs->getByWebsiteIdsLatest($websiteIds);
    }

    public function listClientWebsites(int $userId)
    {
        return $this->websites->getByUserId($userId);
    }

    public function createClientBlog(array $data): void
    {
        $slug = Str::slug($data['title']);

        $this->blogs->create([
            'website_id' => $data['website_id'] ?? null,
            'title' => $data['title'],
            'slug' => $slug,
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'content' => $data['content'],
            'status' => $data['status'] ?? 'draft',
        ]);
    }
}


