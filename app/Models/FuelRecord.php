<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'refuel_date',
        'start_km',
        'kilometer',
        'fuel_amount',
        'fuel_type',
        'price_per_liter',
        'fuel_cost',
        'location',
        'notes',
    ];

    protected $casts = [
        'refuel_date' => 'date',
        'start_km' => 'decimal:2',
        'kilometer' => 'decimal:2',
        'fuel_amount' => 'decimal:2',
        'price_per_liter' => 'decimal:2',
        'fuel_cost' => 'decimal:2',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function attachments()
    {
        return $this->hasMany(FuelAttachment::class);
    }

    public function getCalculatedFuelCostAttribute()
    {
        if ($this->price_per_liter && $this->fuel_amount) {
            return $this->price_per_liter * $this->fuel_amount;
        }

        return $this->fuel_cost;
    }

    public function getFuelConsumptionAttribute()
    {
        $previousRecord = FuelRecord::where('vehicle_id', $this->vehicle_id)
            ->where('refuel_date', '<', $this->refuel_date)
            ->orderBy('refuel_date', 'desc')
            ->first();

        if (! $previousRecord || $this->fuel_amount <= 0) {
            return null;
        }

        $distance = $this->kilometer - $previousRecord->kilometer;

        if ($distance <= 0) {
            return null;
        }

        $consumption = ($this->fuel_amount / $distance) * 100;

        return round($consumption, 2);
    }

    public function getDistanceTraveledAttribute()
    {
        $previousRecord = FuelRecord::where('vehicle_id', $this->vehicle_id)
            ->where('refuel_date', '<', $this->refuel_date)
            ->orderBy('refuel_date', 'desc')
            ->first();

        if (! $previousRecord) {
            return null;
        }

        return $this->kilometer - $previousRecord->kilometer;
    }
}
