<?php

namespace App\Observers;

use App\Models\VehicleType;

class VehicleTypeObserver
{
    public function created(VehicleType $vehicleType): void
    {
        setTableCache('vehicle_types');
    }

    public function updated(VehicleType $vehicleType): void
    {
        setTableCache('vehicle_types');
    }

    public function deleted(VehicleType $vehicleType): void
    {
        setTableCache('vehicle_types');
    }
}
