<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RepairProject extends Model
{
    protected $fillable = [
        'title',
        'vehicle_name',
        'brand_id',
        'vehicle_model',
        'description',
        'status',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(RepairProjectImage::class)
            ->orderByRaw("CASE stage WHEN 'before' THEN 1 WHEN 'during' THEN 2 WHEN 'after' THEN 3 END")
            ->orderBy('sort_order');
    }

    public function scopePublicQuery(Builder $query): Builder
    {
        return $query->where('status', 'yes')
            ->with(['brand', 'images'])
            ->orderBy('sort_order')
            ->orderByDesc('is_featured')
            ->orderBy('title');
    }
}