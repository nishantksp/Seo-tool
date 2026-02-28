<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnpageReport extends Model
{
 protected $fillable = [
    'website_id',
    'url',
    'title_length',
    'meta_length',
    'h1_count',
    'h2_count',
    'image_alt_missing',
    'internal_links',
    'seo_score',
    'checked_at',
];

public function website()
{
    return $this->belongsTo(\App\Models\Website::class);
}

public function calculateScore()
{
    $score = 0;

    if ($this->title_length >= 50 && $this->title_length <= 60) $score += 20;
    if ($this->meta_length >= 140 && $this->meta_length <= 160) $score += 20;
    if ($this->h1_count == 1) $score += 15;
    if ($this->h2_count >= 1) $score += 10;
    if ($this->image_alt_missing == 0) $score += 15;
    if ($this->internal_links >= 3) $score += 10;
    if (strlen($this->url) <= 75) $score += 10;

    return $score;
}
}
