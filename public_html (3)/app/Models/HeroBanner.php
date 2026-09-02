<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class HeroBanner extends Model
{
    protected $fillable = [
        'banner_image',
        'sub_title',
        'main_title',
        'sort_paragraph'
    ];

    public static function firstBanner(): ?self
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return null;
        }

        return static::query()->first();
    }
}
