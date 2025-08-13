<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallVehicle extends Model
{
    use SoftDeletes;

    protected $with = ['vehicle'];

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id')->withTrashed();
    }
}
