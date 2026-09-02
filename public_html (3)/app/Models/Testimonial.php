<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Testimonial extends Model
{
    protected $fillable = [
        'username',
        'feedback'
    ];

    public static function latestTestimonials()
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return collect();
        }

        return static::query()->latest()->get();
    }
}
