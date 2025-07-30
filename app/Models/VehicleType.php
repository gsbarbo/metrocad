<?php

namespace App\Models;

use App\Observers\VehicleTypeObserver;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

#[ObservedBy([VehicleTypeObserver::class])]
class VehicleType extends Model implements Auditable
{
    use AuditingAuditable, CascadeSoftDeletes, SoftDeletes;

    protected $guarded = [];

    protected $cascadeDeletes = ['vehicles']; // vehicles

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
