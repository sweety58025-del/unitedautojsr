<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ServicePrice extends Model
{
    protected $fillable = [
        'item',
        'small_car_price',
        'medium_price',
        'suv_muv_price',
        'premium_price'
    ];

    public static function allPrices()
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return collect();
        }

        return static::query()->get();
    }
}
