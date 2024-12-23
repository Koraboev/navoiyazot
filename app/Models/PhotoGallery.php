<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    use HasFactory;
    protected $fillable=['name','images','lang','slug'];
    protected $casts = [
        'images' => 'array',
    ];
}
