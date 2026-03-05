<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use SoftDeletes;
    protected $fillable = [
    'user_id',
    'domain',
    'niche',
    'country',
    'status',
];

/**
 * Website belongs to a client user.
 */
public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

/**
 * Assignment rows for this website.
 */
public function keywordAssignments()
{
    return $this->hasMany(\App\Models\KeywordAssignment::class);
}

/**
 * Keywords linked to this website (via assignments).
 */
public function keywords()
{
    // Shortcut for reporting without losing assignment metadata.
    return $this->belongsToMany(\App\Models\Keyword::class, 'keyword_assignments');
}
}
