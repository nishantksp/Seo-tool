<?php

namespace App\Services;

use App\Models\SocialPost;
use App\Repositories\SocialPostRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SocialPostService
{
    public function __construct(
        private SocialPostRepository $posts,
        private WebsiteRepository $websites
    ) {
    }

    public function listAdminPosts(?string $platform, int $perPage = 10): LengthAwarePaginator
    {
        return $this->posts->getLatestWithWebsiteUserPaginated($platform, $perPage);
    }

    public function listAdminWebsites()
    {
        return $this->websites->getAllWithUser();
    }

    public function listClientWebsites(int $userId)
    {
        return $this->websites->getByUserId($userId);
    }

    public function createAdminPost(array $data): void
    {
        $this->posts->create($data);
    }

    public function getAdminPostForEdit(int $id): SocialPost
    {
        return $this->posts->findOrFail($id);
    }

    public function updateAdminPost(SocialPost $post, array $data): void
    {
        $this->posts->update($post, $data);
    }

    public function deleteAdminPost(int $id): void
    {
        $this->posts->deleteById($id);
    }

    public function listClientPostsWithStats(int $userId): array
    {
        $websiteIds = $this->websites->getIdsByUserId($userId);
        $posts = $this->posts->getByWebsiteIdsLatest($websiteIds);

        return [
            'posts' => $posts,
            'totalPosts' => $posts->count(),
            'totalClicks' => $posts->sum('clicks'),
            'totalEngagement' => $posts->sum('engagement'),
        ];
    }

    public function createClientPost(array $data): void
    {
        $this->posts->create($data);
    }
}


