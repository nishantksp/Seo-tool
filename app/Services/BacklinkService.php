<?php

namespace App\Services;

use App\Models\Backlink;
use App\Repositories\BacklinkRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BacklinkService
{
    public function __construct(
        private BacklinkRepository $backlinks,
        private WebsiteRepository $websites
    ) {
    }

    public function listAdminBacklinks(int $perPage = 10): LengthAwarePaginator
    {
        return $this->backlinks->getLatestWithWebsiteUserPaginated($perPage);
    }

    public function listAdminWebsites(): Collection
    {
        return $this->websites->getAllWithUser();
    }

    public function createBacklink(array $data): void
    {
        $this->backlinks->create($data);
    }

    public function getBacklinkForEdit(int $id): Backlink
    {
        return $this->backlinks->findOrFail($id);
    }

    public function updateBacklink(Backlink $backlink, array $data): void
    {
        $this->backlinks->update($backlink, $data);
    }

    public function deleteBacklink(int $id): void
    {
        $this->backlinks->deleteById($id);
    }

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


