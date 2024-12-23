<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
        'image',
        'slug',
        'lang',
        'category_id',
        'seo','seo_title','seo_description'
    ];

    function Category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
}
