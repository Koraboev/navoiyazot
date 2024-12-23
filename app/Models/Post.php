<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','text','image','type','slug','lang','seo','seo_title','seo_description'
    ];

    protected $casts = [
        'image' => 'array',
    ];

    function currentId()
    {
        return Post::latest()->first();
    }
}
