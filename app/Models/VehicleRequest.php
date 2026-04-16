<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VehicleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrower_id',
        'vehicle_id',
        'driver_id',
        'destination',
        'purpose',
        'start_datetime',
        'end_datetime',
        'status',
        'manager_notes',
        'admin_notes',
        'approved_by',
        'assigned_by',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function usageRecord()
    {
        return $this->hasOne(UsageRecord::class, 'request_id');
    }

    public function getStatusBadgeAttribute()
    {
        if (Auth::check() && Auth::user()->role === 'driver' && $this->status === 'admin_approved') {
            return 'warning';
        }

        $badges = [
            'pending' => 'warning',
            'manager_approved' => 'success',
            'manager_rejected' => 'danger',
            'admin_approved' => 'success',
            'admin_rejected' => 'danger',
            'in_progress' => 'info',
            'completed' => 'success',
            'driver_cancelled' => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }
}
