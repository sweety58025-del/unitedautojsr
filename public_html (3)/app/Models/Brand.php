<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];

    public static function allBrands()
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return collect();
        }

        return static::query()->get();
    }
}
