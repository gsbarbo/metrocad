<?php

namespace App\Enums\Civilian;

use App\Traits\BaseEnumTrait;

enum VehicleStatus: string
{
    use BaseEnumTrait;

    case Active = 'active';
    case Stolen = 'stolen';
    case Impounded = 'impounded';
}
