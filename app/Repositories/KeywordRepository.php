<?php

namespace App\Repositories;

use App\Models\Keyword;

class KeywordRepository
{
    /**
     * Find a keyword by case-insensitive match.
     */
    public function findByKeyword(string $keyword): ?Keyword
    {
        return Keyword::whereRaw('LOWER(keyword) = ?', [mb_strtolower($keyword)])->first();
    }

    /**
     * Create a new keyword.
     */
    public function create(array $data): Keyword
    {
        return Keyword::create($data);
    }

    /**
     * Find a keyword or fail.
     */
    public function findOrFail(int $id): Keyword
    {
        return Keyword::findOrFail($id);
    }

    /**
     * Update a keyword's attributes.
     */
    public function update(Keyword $keyword, array $data): Keyword
    {
        $keyword->update($data);
        return $keyword;
    }

    /**
     * Delete a keyword by id.
     */
    public function deleteById(int $id): void
    {
        Keyword::destroy($id);
    }

    /**
     * Count total keywords.
     */
    public function countAll(): int
    {
        return Keyword::count();
    }
}
