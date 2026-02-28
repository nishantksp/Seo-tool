<?php

namespace App\Services;

use App\Models\Keyword;
use App\Repositories\KeywordRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class KeywordService
{
    public function __construct(
        private KeywordRepository $keywords,
        private WebsiteRepository $websites
    ) {
    }

    public function listAdminKeywords(int $perPage = 10): LengthAwarePaginator
    {
        return $this->keywords->getLatestWithWebsiteUserPaginated($perPage);
    }

    public function listAdminWebsites(): Collection
    {
        return $this->websites->getAllWithUser();
    }

    public function createKeyword(array $data): void
    {
        $this->keywords->create($data);
    }

    public function getKeywordForEdit(int $id): Keyword
    {
        return $this->keywords->findOrFail($id);
    }

    public function updateKeyword(Keyword $keyword, array $data): void
    {
        $this->keywords->update($keyword, $data);
    }

    public function deleteKeyword(int $id): void
    {
        $this->keywords->deleteById($id);
    }

    public function listClientKeywordsWithLatestRanking(int $userId): Collection
    {
        $websiteIds = $this->websites->getIdsByUserId($userId);
        return $this->keywords->getByWebsiteIdsWithLatestRanking($websiteIds);
    }

    // getting all keywords for a website
    public function getKeywordsByWebsiteId($id){
        return $this->keywords->getByWebsiteIdsWithLatestRanking(collect([$id]));
    }
}


