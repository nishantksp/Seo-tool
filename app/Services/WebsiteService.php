<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Collection;

class WebsiteService
{
    public function __construct(
        private WebsiteRepository $websites,
        private UserRepository $users
    ) {
    }

    public function listAdminWebsites(): Collection
    {
        return $this->websites->getAllWithUserLatest();
    }

    public function listClients(): Collection
    {
        return $this->users->getClients();
    }

    public function listClientWebsites(int $userId): Collection
    {
        return $this->websites->getByUserId($userId);
    }

    public function createWebsite(array $data): void
    {
        $this->websites->create($data);
    }
}


