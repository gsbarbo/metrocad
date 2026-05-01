<?php

namespace App\Enums\Civilian;

use App\Traits\BaseEnumTrait;

enum Race: string
{
    use BaseEnumTrait;

    case White = 'white';
    case Black = 'black';
    case Hispanic = 'hispanic';
    case Asian = 'asian';
    case NativeAmerican = 'native_american';
    case Other = 'other';
}
