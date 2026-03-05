<?php

namespace App\Services;

use App\Models\KeywordAssignment;
use App\Repositories\KeywordAssignmentRepository;
use App\Repositories\KeywordRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class KeywordService
{
    /**
     * Keyword services coordinate keyword reuse and assignment metadata.
     */
    public function __construct(
        private KeywordRepository $keywords,
        private KeywordAssignmentRepository $assignments,
        private WebsiteRepository $websites
    ) {}

    /**
     * Admin listing is assignment-based so each site gets its own row.
     */
    public function listAdminKeywordAssignments(int $perPage = 10): LengthAwarePaginator
    {
        return $this->assignments->getLatestWithWebsiteUserPaginated($perPage);
    }

    /**
     * Used for website dropdowns in admin keyword forms.
     */
    public function listAdminWebsites(): Collection
    {
        return $this->websites->getAllWithUser();
    }

    /**
     * Create an assignment, reusing keywords when possible.
     */
    public function createKeywordAssignment(array $data): void
    {
        $keywordText = trim($data['keyword']);
        $existingKeyword = $this->keywords->findByKeyword($keywordText);

        // Reuse keywords across clients/websites while keeping assignment metadata separate.
        if ($existingKeyword) {
            // Keep keyword metrics in sync when the admin provides updates.
            $this->keywords->update($existingKeyword, [
                'search_volume' => $data['search_volume'] ?? $existingKeyword->search_volume,
                'difficulty' => $data['difficulty'] ?? $existingKeyword->difficulty,
                'intent' => $data['intent'] ?? $existingKeyword->intent,
                'language' => $data['language'] ?? $existingKeyword->language,
                'country' => $data['country'] ?? $existingKeyword->country,
                'cpc' => $data['cpc'] ?? $existingKeyword->cpc,
                'competition' => $data['competition'] ?? $existingKeyword->competition,
                'is_branded' => $data['is_branded'] ?? $existingKeyword->is_branded,
            ]);
            $keyword = $existingKeyword;
        } else {
            $keyword = $this->keywords->create([
                'keyword' => $keywordText,
                'search_volume' => $data['search_volume'] ?? null,
                'difficulty' => $data['difficulty'] ?? null,
                'intent' => $data['intent'] ?? null,
                'language' => $data['language'] ?? 'en',
                'country' => $data['country'] ?? null,
                'cpc' => $data['cpc'] ?? null,
                'competition' => $data['competition'] ?? null,
                'is_branded' => $data['is_branded'] ?? false,
            ]);
        }

        $this->assignments->create([
            'website_id' => $data['website_id'],
            'keyword_id' => $keyword->id,
            'target_url' => $data['target_url'] ?? null,
            'priority' => $data['priority'] ?? null,
            'status' => $data['status'] ?? 'active',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Fetch an assignment for edit.
     */
    public function getAssignmentForEdit(int $id): KeywordAssignment
    {
        return $this->assignments->findOrFail($id);
    }

    /**
     * Update assignment + keyword metrics.
     */
    public function updateAssignment(KeywordAssignment $assignment, array $data): void
    {
        $keywordText = trim($data['keyword']);
        $existingKeyword = $this->keywords->findByKeyword($keywordText);

        // Reuse or create keyword, keep metrics updated.
        if ($existingKeyword) {
            $this->keywords->update($existingKeyword, [
                'search_volume' => $data['search_volume'] ?? $existingKeyword->search_volume,
                'difficulty' => $data['difficulty'] ?? $existingKeyword->difficulty,
                'intent' => $data['intent'] ?? $existingKeyword->intent,
                'language' => $data['language'] ?? $existingKeyword->language,
                'country' => $data['country'] ?? $existingKeyword->country,
                'cpc' => $data['cpc'] ?? $existingKeyword->cpc,
                'competition' => $data['competition'] ?? $existingKeyword->competition,
                'is_branded' => $data['is_branded'] ?? $existingKeyword->is_branded,
            ]);
            $keyword = $existingKeyword;
        } else {
            $keyword = $this->keywords->create([
                'keyword' => $keywordText,
                'search_volume' => $data['search_volume'] ?? null,
                'difficulty' => $data['difficulty'] ?? null,
                'intent' => $data['intent'] ?? null,
                'language' => $data['language'] ?? 'en',
                'country' => $data['country'] ?? null,
                'cpc' => $data['cpc'] ?? null,
                'competition' => $data['competition'] ?? null,
                'is_branded' => $data['is_branded'] ?? false,
            ]);
        }

        $this->assignments->update($assignment, [
            'website_id' => $data['website_id'],
            'keyword_id' => $keyword->id,
            'target_url' => $data['target_url'] ?? null,
            'priority' => $data['priority'] ?? null,
            'status' => $data['status'] ?? 'active',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Delete an assignment (keyword stays available for other websites).
     */
    public function deleteAssignment(int $id): void
    {
        $this->assignments->deleteById($id);
    }

    /**
     * Client keyword listing with latest rank for dashboards.
     */
    public function listClientKeywordsWithLatestRanking(int $userId): Collection
    {
        $websiteIds = $this->websites->getIdsByUserId($userId);
        return $this->assignments->getByWebsiteIdsWithLatestRanking($websiteIds);
    }

    // getting all keywords for a website
    /**
     * Filter keywords for a single website id.
     */
    public function getKeywordsByWebsiteId($id)
    {
        return $this->assignments->getByWebsiteIdsWithLatestRanking(collect([$id]));
    }
}
