<?php

namespace App\Models;

use App\Enum\VehicleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'expires_at' => 'date',
        'status' => VehicleStatus::class,
    ];

    public function civilian()
    {
        return $this->belongsTo(Civilian::class);
    }

    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
