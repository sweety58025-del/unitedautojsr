<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Gallery extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];

    public static function allGalleries()
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return collect();
        }

        return static::query()->latest()->get();
    }
}
