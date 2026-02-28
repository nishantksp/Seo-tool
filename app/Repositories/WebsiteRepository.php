<?php

namespace App\Repositories;

use App\Models\Website;
use Illuminate\Support\Collection;

class WebsiteRepository
{
    public function getAllWithUserLatest(): Collection
    {
        return Website::with('user')->latest()->get();
    }

    public function getAllWithUser(): Collection
    {
        return Website::with('user')->get();
    }

    public function getByUserId(int $userId): Collection
    {
        return Website::where('user_id', $userId)->get();
    }

    public function getIdsByUserId(int $userId): Collection
    {
        return Website::where('user_id', $userId)->pluck('id');
    }

    public function create(array $data): Website
    {
        return Website::create($data);
    }

    public function countAll(): int
    {
        return Website::count();
    }
}


