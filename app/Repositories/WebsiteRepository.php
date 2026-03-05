<?php

namespace App\Repositories;

use App\Models\Website;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class WebsiteRepository
{
    /**
     * Admin listing with client details.
     */
    // public function getAllWithUserLatest(): Collection
    // {
    //     // Admin view for all websites
    //     return Website::with('user')->latest()->get();
    // }

    public function getAllWithUserLatest(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return Website::with('user')
            ->withCount('keywords')
            ->when($filters['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
            ->when($filters['client_id'] ?? null, fn ($q, $clientId) => $q->where('user_id', $clientId))
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('domain', 'like', "%{$search}%")
                  ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate($perPage);
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

    //getting websites with selected status
    public function countByStatus(string $status): int 
    {
        return Website::where('status', $status)->count();
    }

    //getting website which is created  this month
    public function countCreatedThisMonth(): int{
        return Website::whereBetween('created_at',
        [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
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

    //restoring a soft deleted website
    public function restore(int $id):void{
        Website::withTrashed()->findOrFail($id)->restore();
    }


}
