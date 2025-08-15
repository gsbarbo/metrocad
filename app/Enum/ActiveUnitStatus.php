<?php

namespace App\Enum;

enum ActiveUnitStatus: string
{
    case Available = 'AVL';
    case AtStation = 'AVL - AT STN';
    case EnRoute = 'ENRUTE';
    case Transporting = 'TRNSP';
    case OnScene = 'ONSCN';
    case EnRouteToStation = 'ENRUTE - STN';

    case Busy = 'BSY';
    case Break = 'BRK';
    case OffDuty = 'OFFDTY';

    public static function options(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(fn (self $case) => $case->label(), self::cases())
        );
    }

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Available',
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
            self::Available => 'bg-green-600',
            self::AtStation => 'bg-blue-600',
            self::EnRoute => 'bg-yellow-600',
            self::Transporting => 'bg-purple-600',
            self::OnScene => 'bg-red-600',
            self::EnRouteToStation => 'bg-indigo-600',
            self::Busy => 'bg-gray-600',
            self::Break => 'bg-orange-600',
            self::OffDuty => 'bg-red-600',
        };
    }
}
