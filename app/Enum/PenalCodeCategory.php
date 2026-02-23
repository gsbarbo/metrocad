<?php

namespace App\Enum;

use App\Traits\BaseEnumTrait;

enum PenalCodeCategory: string
{
    use BaseEnumTrait;

    case CRIMINAL = 'criminal';
    case TRAFFIC = 'traffic';
    case ORDINANCE = 'local_ordinance';
}
