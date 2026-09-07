<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairProjectImage extends Model
{
    protected $fillable = [
        'repair_project_id',
        'stage',
        'image',
        'caption',
        'sort_order',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(RepairProject::class, 'repair_project_id');
    }
}