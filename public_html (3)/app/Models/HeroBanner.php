<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = [
        'banner_image',
        'sub_title',
        'main_title',
        'sort_paragraph'
    ];
}
