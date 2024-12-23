<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable=[
        'banner_title',
        'banner_text',
        'banner_subtext',
        'banner_video',
        'about_title',
        'about_text',
        'about_subtext',
        'about_advantage_1',
        'about_advantage_2',
        'about_advantage_3',
        'about_advantage_4',
        'about_image_1',
        'about_image_2',
        'company_title',
        'company_mission',
        'company_history',
        'company_quality',
        'company_innovation',
        'company_partnership',
        'company_stability',
        'company_staffes',
        'company_products',
        'company_age',
        'company_divisions',
        'company_image',
        'gallery_image_1',
        'gallery_image_2',
        'gallery_image_3',
        'gallery_image_4',
        'gallery_image_5',
        'gallery_image_6',
        'gallery_image_7',
        'gallery_image_8',
        'gallery_title',
        'videoblock_title',
        'videoblock_adv_1',
        'videoblock_adv_2',
        'videoblock_adv_3',
        'videoblock_video',
        'seo',
        'seo_title',
        'seo_description',
        'lang',
    ];
}
