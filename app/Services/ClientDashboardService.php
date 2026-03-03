<?php

namespace App\Services;

use App\Repositories\BacklinkRepository;
use App\Repositories\KeywordAssignmentRepository;
use App\Repositories\WebsiteRepository;

class ClientDashboardService
{
    /**
     * Client dashboard stats dependencies.
     */
    public function __construct(
        private WebsiteRepository $websites,
        private KeywordAssignmentRepository $assignments,
        private BacklinkRepository $backlinks
    ) {
    }

    /**
     * Aggregate counts for the client dashboard.
     */
    public function getStats(int $userId): array
    {
        $websiteIds = $this->websites->getIdsByUserId($userId);

        return [
            'keywords' => $this->assignments->getByWebsiteIdsWithLatestRanking($websiteIds)->count(),
            'backlinks' => $this->backlinks->getByWebsiteIds($websiteIds)->count(),
        ];
    }
}
