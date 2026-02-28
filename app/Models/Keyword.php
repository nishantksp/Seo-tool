<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
   public function rankings()
{
    return $this->hasMany(\App\Models\KeywordRanking::class);
}
protected $fillable = [
    'website_id',
    'keyword',
    'search_volume',
    'difficulty',
];

public function website()
{
    return $this->belongsTo(\App\Models\Website::class);
}

}
