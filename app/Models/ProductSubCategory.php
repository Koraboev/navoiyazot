<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','parent_id','slug','lang','image','seo','seo_title','seo_description'
    ];

    function ParentCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id', 'id');
    }

    function Page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
}
