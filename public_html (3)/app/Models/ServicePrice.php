<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    protected $fillable = [
        'item',
        'small_car_price',
        'medium_price',
        'suv_muv_price',
        'premium_price'
    ];
}
