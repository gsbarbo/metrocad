<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum CivilianStatus: string
{
    use BaseEnumTrait;

    case Alive = 'alive';
    case Wanted = 'wanted';
    case Jailed = 'jailed';
    case Dead = 'dead';
    case Hospitalized = 'hospitalized';
    case Missing = 'missing';
    case Pending = 'pending';

}
