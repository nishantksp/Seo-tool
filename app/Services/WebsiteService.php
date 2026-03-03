<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Collection;

class WebsiteService
{
    /**
     * Website service orchestration.
     */
    public function __construct(
        private WebsiteRepository $websites,
        private UserRepository $users
    ) {
    }

    /**
     * Admin list of websites.
     */
    public function listAdminWebsites(): Collection
    {
        return $this->websites->getAllWithUserLatest();
    }

    /**
     * Admin list of websites with keywords.
     */
    public function listAdminWebsitesWithKeywords(): Collection
    {
        return $this->websites->getAllWithUserKeywordsLatest();
    }

    /**
     * Fetch clients for dropdowns.
     */
    public function listClients(): Collection
    {
        return $this->users->getClients();
    }

    /**
     * Client-specific websites list.
     */
    public function listClientWebsites(int $userId): Collection
    {
        return $this->websites->getByUserId($userId);
    }

    /**
     * Create a website record.
     */
    public function createWebsite(array $data): void
    {
        $this->websites->create($data);
    }

    /**
     * Fetch a website for editing.
     */
    public function getWebsiteForEdit(int $id)
    {
        return $this->websites->findOrFail($id);
    }

    /**
     * Update a website record.
     */
    public function updateWebsite(int $id, array $data): void
    {
        $website = $this->websites->findOrFail($id);
        $this->websites->update($website, $data);
    }

    /**
     * Delete a website record.
     */
    public function deleteWebsite(int $id): void
    {
        $website = $this->websites->findOrFail($id);
        $this->websites->delete($website);
    }

    /**
     * Temporary list of countries (can be moved to DB later).
     */
    public function getCountries(): array
    {
        return ['India', 'United Kingdom', 'United States', 'Canada', 'Australia'];
    }

    /**
     * Temporary list of niches (can be moved to DB later).
     */
    public function getNiches(): array
    {
        return ['Digital Marketing', 'E-commerce', 'Healthcare', 'Education', 'Real Estate', 'Finance'];
    }

    //getting website with selected website id for dropdown
    /**
     * Dropdown list of websites.
     */
    public function listDropDownWebsites(): Collection{
        return $this->websites->getAllForDropDown();
    }

    /**
     * Websites with keyword assignments, optionally filtered.
     */
    public function listWebsitesWithKeywords(?int $id): Collection
    {
        return $this->websites->getWithKeywordsById($id);
    }

}
