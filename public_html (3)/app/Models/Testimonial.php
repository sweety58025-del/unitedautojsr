<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Testimonial extends Model
{
    protected $fillable = [
        'username',
        'feedback',
        'customer_name',
        'vehicle',
        'vehicle_brand',
        'review',
        'rating',
        'image',
        'status',
        'sort_order',
    ];

    public function getCustomerNameAttribute($value): string
    {
        return $value ?: (string) $this->attributes['username'];
    }

    public function getReviewAttribute($value): string
    {
        return $value ?: (string) $this->attributes['feedback'];
    }

    public static function latestTestimonials()
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return collect();
        }

        return static::query()
            ->where('status', 'yes')
            ->orderBy('sort_order')
            ->latest()
            ->get();
    }
}
