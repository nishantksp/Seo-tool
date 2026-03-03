<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [
        'keyword',
        'search_volume',
        'difficulty',
    ];

    /**
     * Assignments that use this keyword.
     */
    public function assignments()
    {
        return $this->hasMany(\App\Models\KeywordAssignment::class);
    }

    /**
     * Websites using this keyword (via assignments).
     */
    public function websites()
    {
        // Useful for reporting keywords used across multiple sites.
        return $this->belongsToMany(\App\Models\Website::class, 'keyword_assignments');
    }

}
