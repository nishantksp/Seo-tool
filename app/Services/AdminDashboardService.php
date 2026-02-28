<?php

namespace App\Services;

use App\Repositories\KeywordRepository;
use App\Repositories\UserRepository;
use App\Repositories\WebsiteRepository;

class AdminDashboardService
{
    public function __construct(
        private UserRepository $users,
        private WebsiteRepository $websites,
        private KeywordRepository $keywords
    ) {
    }

    public function getStats(): array
    {
        return [
            'clients' => $this->users->countClients(),
            'websites' => $this->websites->countAll(),
            'keywords' => $this->keywords->countAll(),
        ];
    }
}


