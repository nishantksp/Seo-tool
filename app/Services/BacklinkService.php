<?php

namespace App\Services;

use App\Models\Backlink;
use App\Repositories\BacklinkRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BacklinkService
{
    /**
     * Backlink orchestration depends on repositories for data access.
     */
    public function __construct(
        private BacklinkRepository $backlinks,
        private WebsiteRepository $websites
    ) {
    }

    /**
     * Paginated admin list of backlinks with website/user context.
     */
    public function listAdminBacklinks(int $perPage = 10): LengthAwarePaginator
    {
        return $this->backlinks->getLatestWithWebsiteUserPaginated($perPage);
    }

    /**
     * Fetch websites for backlink forms.
     */
    public function listAdminWebsites(): Collection
    {
        return $this->websites->getAllWithUser();
    }

    /**
     * Create a backlink entry.
     */
    public function createBacklink(array $data): void
    {
        $this->backlinks->create($data);
    }

    /**
     * Get a backlink for editing.
     */
    public function getBacklinkForEdit(int $id): Backlink
    {
        return $this->backlinks->findOrFail($id);
    }

    /**
     * Update a backlink entry.
     */
    public function updateBacklink(Backlink $backlink, array $data): void
    {
        $this->backlinks->update($backlink, $data);
    }

    /**
     * Remove a backlink by id.
     */
    public function deleteBacklink(int $id): void
    {
        $this->backlinks->deleteById($id);
    }

    /**
     * Client stats used on the client dashboard.
     */
    public function listClientBacklinksWithStats(int $userId): array
    {
        $websiteIds = $this->websites->getIdsByUserId($userId);
        $backlinks = $this->backlinks->getByWebsiteIds($websiteIds);

        return [
            'backlinks' => $backlinks,
            'total' => $backlinks->count(),
            'active' => $backlinks->where('status', 'active')->count(),
            'lost' => $backlinks->where('status', 'lost')->count(),
            'dofollow' => $backlinks->where('link_type', 'dofollow')->count(),
        ];
    }
}

