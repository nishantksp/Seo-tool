<?php

namespace App\Services;

use App\Repositories\KeywordAssignmentRepository;
use App\Repositories\UserRepository;
use App\Repositories\WebsiteRepository;

class AdminDashboardService
{
    /**
     * Admin dashboard stats dependencies.
     */
    public function __construct(
        private UserRepository $users,
        private WebsiteRepository $websites,
        private KeywordAssignmentRepository $assignments
    ) {
    }

    /**
     * Aggregate counts for the admin dashboard.
     */
    public function getStats(): array
    {
        return [
            'clients' => $this->users->countClients(),
            'websites' => $this->websites->countAll(),
            'keywords' => $this->assignments->countAll(),
        ];
    }
}
