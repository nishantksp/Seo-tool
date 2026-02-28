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

    public function listAdminWebsitesWithKeywords(): Collection
    {
        return $this->websites->getAllWithUserKeywordsLatest();
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

    public function getWebsiteForEdit(int $id)
    {
        return $this->websites->findOrFail($id);
    }

    public function updateWebsite(int $id, array $data): void
    {
        $website = $this->websites->findOrFail($id);
        $this->websites->update($website, $data);
    }

    public function deleteWebsite(int $id): void
    {
        $website = $this->websites->findOrFail($id);
        $this->websites->delete($website);
    }

    public function getCountries(): array
    {
        return ['India', 'United Kingdom', 'United States', 'Canada', 'Australia'];
    }

    public function getNiches(): array
    {
        return ['Digital Marketing', 'E-commerce', 'Healthcare', 'Education', 'Real Estate', 'Finance'];
    }

    //getting website with selected website id for dropdown
    public function listDropDownWebsites(): Collection{
        return $this->websites->getAllForDropDown();
    }

    public function listWebsitesWithKeywords(?int $id): Collection
    {
        return $this->websites->getWithKeywordsById($id);
    }

}

