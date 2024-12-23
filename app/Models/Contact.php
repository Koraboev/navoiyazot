<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'number_1',
        'number_2',
        'number_3',
        'number_4',
        'email_1',
        'email_2',
        'address',
        'map',
        'helpline',
        'telegram',
        'facebook',
        'youtube',
        'instagram',
        'text',
        'lang'
    ];
}
