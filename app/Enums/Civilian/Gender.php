<?php

namespace App\Enums\Civilian;

use App\Traits\BaseEnumTrait;

enum Gender: string
{
    use BaseEnumTrait;

    case Male = 'male';
    case Female = 'female';
    case Other = 'other';
}
