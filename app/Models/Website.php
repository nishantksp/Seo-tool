<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = [
    'user_id',
    'domain',
    'niche',
    'country',
];

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
<<<<<<< HEAD
public function keywords()
{
    return $this->hasMany(\App\Models\Keyword::class);
}
=======

public function keywords()
{
    return $this->hasMany(\App\Models\Keyword::class);
>>>>>>> 70a630377b5089423cc6304de09fa52cc5b6aa9c
}
}

