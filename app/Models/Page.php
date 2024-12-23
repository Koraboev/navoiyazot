<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'seo',
        'seo_title',
        'seo_description',
        'description',
        'short_description',
        'type',
        'lang',
        'status'
    ];

}
