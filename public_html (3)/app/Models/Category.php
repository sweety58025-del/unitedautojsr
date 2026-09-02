<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name','slug','description','status','category_image',
    ];

    public static function activeServices()
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return collect();
        }

        return static::query()->where('status', 'yes')->get();
    }

    /**
     * Get the subcategories for this category.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
