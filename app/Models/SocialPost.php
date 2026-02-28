<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
  
protected $fillable = [
    'website_id',
    'platform',
    'post_url',
    'clicks',
    'engagement',
    'date',
];

public function website()
{
    return $this->belongsTo(\App\Models\Website::class);
}
}
