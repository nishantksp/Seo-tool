<?php

namespace App\Repositories;

use App\Models\Website;
use Illuminate\Support\Collection;

class WebsiteRepository
{
    /**
     * Admin listing with client details.
     */
    public function getAllWithUserLatest(): Collection
    {
        return Website::with('user')->latest()->get();
    }

    /**
     * Admin listing with assignments/keywords.
     */
    public function getAllWithUserKeywordsLatest(): Collection
    {
        return Website::with(['user', 'keywordAssignments.keyword'])->latest()->get();
    }

    /**
     * Fetch all websites with their client.
     */
    public function getAllWithUser(): Collection
    {
        return Website::with('user')->get();
    }

    /**
     * Get websites owned by a client.
     */
    public function getByUserId(int $userId): Collection
    {
        return Website::where('user_id', $userId)->get();
    }

    /**
     * Get ids for a client's websites.
     */
    public function getIdsByUserId(int $userId): Collection
    {
        return Website::where('user_id', $userId)->pluck('id');
    }

    /**
     * Create a website record.
     */
    public function create(array $data): Website
    {
        return Website::create($data);
    }

    /**
     * Find a website or fail.
     */
    public function findOrFail(int $id): Website
    {
        return Website::findOrFail($id);
    }

    /**
     * Update a website record.
     */
    public function update(Website $website, array $data): Website
    {
        $website->update($data);
        return $website;
    }

    /**
     * Delete a website record.
     */
    public function delete(Website $website): void
    {
        $website->delete();
    }

    /**
     * Count all websites.
     */
    public function countAll(): int
    {
        return Website::count();
    }
    //getting all websites with selected website id and domain for dropdown
    /**
     * Dropdown list for website filters.
     */
    public function getAllForDropDown():Collection
    {
        return Website::select('id','domain')->orderBy('domain')->get();
    }

    //getting keyword for selected website id
    /**
     * Load keywords for a specific website.
     */
    public function getWithKeywordsById(?int $id):Collection{
        return Website::with('keywordAssignments.keyword')
        ->when($id, fn($q)=>$q->where('id', $id))
        ->latest()
        ->get();
    }


}
