<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'service_id',
        'service_name',
        'service_price',
        'vehicle_make_model',
        'registration_number',
        'appointment_date',
        'appointment_time',
        'customer_name',
        'customer_email',
        'customer_phone',
        'service_reason',
        'preferred_contact_method',
        'additional_issues',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'service_price' => 'decimal:2',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
