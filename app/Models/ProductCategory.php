<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','lang','image','seo','seo_title','seo_description'
    ];

    function Page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
}
