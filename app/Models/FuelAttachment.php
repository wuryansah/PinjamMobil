<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'fuel_record_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function fuelRecord()
    {
        return $this->belongsTo(FuelRecord::class);
    }
}