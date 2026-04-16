<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'start_km',
        'start_time',
        'end_km',
        'end_time',
        'fuel_used',
        'notes',
    ];

    public function request()
    {
        return $this->belongsTo(VehicleRequest::class, 'request_id');
    }
}
