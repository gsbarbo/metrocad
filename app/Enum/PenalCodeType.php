<?php

namespace App\Enum;

use App\Traits\BaseEnumTrait;

enum PenalCodeType: string
{
    use BaseEnumTrait;
    case FELONY = 'felony';
    case MISDEMEANOR = 'misdemeanor';
    case INFRACTION = 'infraction';
    case TRAFFIC = 'traffic';
    case ORDINANCE = 'ordinance';
}
