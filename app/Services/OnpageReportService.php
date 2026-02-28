<?php

namespace App\Services;

use App\Models\OnpageReport;
use App\Repositories\OnpageReportRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OnpageReportService
{
    public function __construct(
        private OnpageReportRepository $reports,
        private WebsiteRepository $websites
    ) {
    }

    public function listAdminReports(int $perPage = 10): LengthAwarePaginator
    {
        return $this->reports->getLatestWithWebsiteUserPaginated($perPage);
    }

    public function listAdminWebsites(): Collection
    {
        return $this->websites->getAllWithUser();
    }

    public function createReport(array $data): void
    {
        $report = new OnpageReport($data);
        $report->seo_score = $report->calculateScore();
        $report->checked_at = now();

        $this->reports->save($report);
    }

    public function deleteReport(int $id): void
    {
        $this->reports->deleteById($id);
    }

    public function listClientReports(int $userId): Collection
    {
        $websiteIds = $this->websites->getIdsByUserId($userId);
        return $this->reports->getByWebsiteIdsLatest($websiteIds);
    }
}


