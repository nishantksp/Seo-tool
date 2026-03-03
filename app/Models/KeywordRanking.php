<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeywordRanking extends Model
{

protected $fillable = [
    'keyword_assignment_id',
    'rank',
    'previous_rank',
    'checked_at',
    'search_engine',
    'location',
    'device_type',
];

/**
 * Ranking belongs to a specific keyword assignment.
 */
public function assignment()
{
    return $this->belongsTo(\App\Models\KeywordAssignment::class, 'keyword_assignment_id');
}
}
