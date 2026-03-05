<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeywordAssignment extends Model
{
    protected $fillable = [
        'website_id',
        'keyword_id',
        'target_url',
        'priority',
        'status',
        'notes',
    ];

    /**
     * Assignment references a reusable keyword.
     */
    public function keyword()
    {
        return $this->belongsTo(\App\Models\Keyword::class);
    }

    /**
     * Assignment belongs to a specific website.
     */
    public function website()
    {
        return $this->belongsTo(\App\Models\Website::class);
    }

    /**
     * Ranking history for this assignment.
     */
    public function rankings()
    {
        return $this->hasMany(\App\Models\KeywordRanking::class);
    }

    /**
     * Latest ranking entry for fast display.
     */
    public function latestRanking()
    {
        // Keeps client dashboards fast without manual subqueries.
        return $this->hasOne(\App\Models\KeywordRanking::class)->latestOfMany();
    }
}
