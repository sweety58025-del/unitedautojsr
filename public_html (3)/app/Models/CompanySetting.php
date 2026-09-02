<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CompanySetting extends Model
{
    protected $fillable = [
        'logo','favicon_icon','company_name','phone','email','city','state',
        'pincode','address','pan','gst'
    ];

    public static function firstRecord(): ?self
    {
        if (!Schema::hasTable((new self)->getTable())) {
            return null;
        }

        $record = static::query()->first();

        if ($record) {
            return $record;
        }

        return new self([
            'logo' => 'logo.png',
            'favicon_icon' => 'favicon.png',
            'company_name' => 'United Auto',
            'phone' => '9876543210',
            'email' => 'hello@unitedauto.in',
            'city' => 'Jamshedpur',
            'state' => 'Jharkhand',
            'pincode' => '831007',
            'address' => 'Nagesh Tower, Near Goods Shed Road, Burma Mines',
            'pan' => '',
            'gst' => '',
        ]);
    }
}
