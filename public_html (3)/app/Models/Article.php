<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'yes')
            ->where(function (Builder $query) {
                $query->whereNull('published_at')->orWhereDate('published_at', '<=', now());
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }
}