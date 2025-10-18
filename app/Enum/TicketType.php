<?php

namespace App\Enum;

use App\Interface\BaseEnumInterface;
use App\Traits\BaseEnumTrait;

enum TicketType: string implements BaseEnumInterface
{
    use BaseEnumTrait;

    case WARNING = 'warning';
    case CITATION = 'citation';
    case ARREST = 'arrest';
}
