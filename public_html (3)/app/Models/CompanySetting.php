<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'logo','favicon_icon','company_name','phone','email','city','state',
        'pincode','address','pan','gst'
    ];
}
