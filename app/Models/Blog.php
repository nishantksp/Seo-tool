<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
    'website_id',
    'title',
    'slug',
    'meta_title',
    'meta_description',
    'content',
    'featured_image',
    'status',
];
}
