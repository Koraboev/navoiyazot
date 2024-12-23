<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'lang',
        'parent_id',
        'type',
        'page_id',
        'link',
        'post_type',
        'stage' 	
    ];

    public function Page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
    public function ParentMenu()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }
}
