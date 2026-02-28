<?php

namespace App\Services;

use App\Repositories\BacklinkRepository;
use App\Repositories\KeywordRepository;
use App\Repositories\WebsiteRepository;

class ClientDashboardService
{
    public function __construct(
        private WebsiteRepository $websites,
        private KeywordRepository $keywords,
        private BacklinkRepository $backlinks
    ) {
    }

    public function getStats(int $userId): array
    {
        $websiteIds = $this->websites->getIdsByUserId($userId);

        return [
            'keywords' => $this->keywords->getByWebsiteIdsWithLatestRanking($websiteIds)->count(),
            'backlinks' => $this->backlinks->getByWebsiteIds($websiteIds)->count(),
        ];
    }
}


