<?php

namespace App\Enum;

enum ActiveUnitStatus: string
{
    case Available = 'AVL';
    case EnRoute = 'ENRUTE';
    case OnScene = 'ONSCN';
    case Break = 'BRK';

    case Busy = 'BSY';
    case OffDuty = 'OFFDTY';
    case Transporting = 'TRANS';
    case Panic = 'PANIC';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }
}
