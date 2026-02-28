<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeywordRanking extends Model
{

protected $fillable = [
    'keyword_id',
    'rank',
    'previous_rank',
    'checked_at',
];

public function keyword()
{
    return $this->belongsTo(\App\Models\Keyword::class);
}
}
