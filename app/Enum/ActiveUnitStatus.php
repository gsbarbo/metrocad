<?php

namespace App\Enum;

use App\Interface\BaseEnumInterface;
use App\Traits\BaseEnumTrait;

enum ActiveUnitStatus: string implements BaseEnumInterface
{
    use BaseEnumTrait;

    case Available = 'AVL';
    case AtStation = 'AVL - AT STN';
    case EnRoute = 'ENRUTE';
    case Transporting = 'TRNSP';
    case OnScene = 'ONSCN';
    case EnRouteToStation = 'ENRUTE - STN';

    case Busy = 'BSY';
    case Break = 'BRK';
    case OffDuty = 'OFFDTY';

    public function label(): string
    {
        return match ($this) {
            self::Available => '10-08 Available',
            self::AtStation => 'At Station',
            self::EnRoute => 'En Route',
            self::Transporting => 'Transporting',
            self::OnScene => 'On Scene',
            self::EnRouteToStation => 'En Route to Station',
            self::Busy => 'Busy',
            self::Break => 'Break',
            self::OffDuty => 'Off Duty',
        };
    }

    public function bgColor(): string
    {
        return self::color('background');
    }

    public function color(string $type): string
    {
        if ($type === 'text') {
            return match ($this) {
                self::Available, self::AtStation => 'text-green-600',
                self::EnRoute, self::EnRouteToStation => 'text-yellow-600',
                self::Transporting => 'text-purple-600',
                self::OnScene => 'text-orange-600',
                self::Busy, self::Break => 'text-gray-600',
                self::OffDuty => 'text-red-600',
            };
        }

        return match ($this) {
            self::Available, self::AtStation => 'bg-green-600',
            self::EnRoute, self::EnRouteToStation => 'bg-yellow-600',
            self::Transporting => 'bg-purple-600',
            self::OnScene => 'bg-orange-600',
            self::Busy, self::Break => 'bg-gray-600',
            self::OffDuty => 'bg-red-600',
        };
    }

    public function textColor(): string
    {
        return self::color('text');
    }
}
