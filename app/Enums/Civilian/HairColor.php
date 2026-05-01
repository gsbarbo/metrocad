<?php

namespace App\Enums\Civilian;

use App\Traits\BaseEnumTrait;

enum HairColor: string
{
    use BaseEnumTrait;

    case Black = 'black';
    case Brown = 'brown';
    case Blonde = 'blonde';
    case Red = 'red';
    case Auburn = 'auburn';
    case Gray = 'gray';
    case White = 'white';
    case Bald = 'bald';
    case Other = 'other';
}
