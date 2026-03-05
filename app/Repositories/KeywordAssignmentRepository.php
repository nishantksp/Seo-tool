<?php

namespace App\Repositories;

use App\Models\KeywordAssignment;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class KeywordAssignmentRepository
{
    /**
     * Admin list with website, client, and keyword context.
     */
    public function getLatestWithWebsiteUserPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return KeywordAssignment::with(['website.user', 'keyword','latestRanking'])->latest()->paginate($perPage);
    }

    /**
     * Fetch assignments for given websites with latest ranking.
     */
    public function getByWebsiteIdsWithLatestRanking(Collection $websiteIds): Collection
    {
        return KeywordAssignment::whereIn('website_id', $websiteIds)
            ->with(['keyword', 'latestRanking'])
            ->get();
    }

    /**
     * Create a new keyword assignment.
     */
    public function create(array $data): KeywordAssignment
    {
        return KeywordAssignment::create($data);
    }

    /**
     * Find an assignment or fail.
     */
    public function findOrFail(int $id): KeywordAssignment
    {
        return KeywordAssignment::findOrFail($id);
    }

    /**
     * Update assignment attributes.
     */
    public function update(KeywordAssignment $assignment, array $data): KeywordAssignment
    {
        $assignment->update($data);
        return $assignment;
    }

    /**
     * Delete by id.
     */
    public function deleteById(int $id): void
    {
        KeywordAssignment::destroy($id);
    }

    /**
     * Count all assignments.
     */
    public function countAll(): int
    {
        return KeywordAssignment::count();
    }
}
