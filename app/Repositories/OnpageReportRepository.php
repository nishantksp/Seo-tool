<?php

namespace App\Repositories;

use App\Models\OnpageReport;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OnpageReportRepository
{
    public function getLatestWithWebsiteUserPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return OnpageReport::with('website.user')->latest()->paginate($perPage);
    }

    public function getByWebsiteIdsLatest(Collection $websiteIds): Collection
    {
        return OnpageReport::whereIn('website_id', $websiteIds)->latest()->get();
    }

    public function save(OnpageReport $report): OnpageReport
    {
        $report->save();
        return $report;
    }

    public function deleteById(int $id): void
    {
        OnpageReport::destroy($id);
    }
}


