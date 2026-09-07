<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'sort_order',
        'status',
    ];

    public static function allBrands()
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return collect();
        }

        return static::query()
            ->where('status', 'yes')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
