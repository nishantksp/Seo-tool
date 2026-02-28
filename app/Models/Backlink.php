<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Backlink extends Model
{
    protected $fillable = [
    'website_id',
    'source_url',
    'target_url',
    'anchor_text',
    'link_type',
    'da',
    'status',
];

public function website()
{
    return $this->belongsTo(\App\Models\Website::class);
}
}
