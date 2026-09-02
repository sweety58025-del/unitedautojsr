<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class AboutWebsite extends Model
{
    protected $fillable = [
        'about_title',
        'short_description',
        'description',
        'about_image',
        'mission',
        'vision',
        'why_choose_title_1',
        'why_choose_content_1',
        'why_choose_title_2',
        'why_choose_content_2',
        'why_choose_title_3',
        'why_choose_content_3',
        'why_choose_title_4',
        'why_choose_content_4',
        'service_terms',
    ];

    public static function firstRecord(): ?self
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return null;
        }

        return static::query()->first();
    }
}
