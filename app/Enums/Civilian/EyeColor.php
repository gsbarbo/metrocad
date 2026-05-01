<?php

namespace App\Enums\Civilian;

use App\Traits\BaseEnumTrait;

enum EyeColor: string
{
    use BaseEnumTrait;

    case Brown = 'brown';
    case Blue = 'blue';
    case Green = 'green';
    case Hazel = 'hazel';
    case Gray = 'gray';
    case Amber = 'amber';
    case Other = 'other';

}
