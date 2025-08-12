<?php

namespace App\Enum;

enum CallResource: string
{
    case AMBULANCE = 'ambulance';
    case FIRE_ENGINE = 'fire_engine';
    case POLICE_UNIT = 'police_unit';
    case EMS_UNIT = 'ems_unit';
    case HELICOPTER = 'helicopter';
    case K9_UNIT = 'k9_unit';
    case TOW_TRUCK = 'tow_truck';
    case HAZMAT_UNIT = 'hazmat_unit';
    case SWAT_TEAM = 'swat_team';
    case OTHER = 'other';

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
            self::AMBULANCE => 'Ambulance',
            self::FIRE_ENGINE => 'Fire Engine',
            self::POLICE_UNIT => 'Police Unit',
            self::EMS_UNIT => 'EMS Unit',
            self::HELICOPTER => 'Helicopter',
            self::K9_UNIT => 'K9 Unit',
            self::TOW_TRUCK => 'Tow Truck',
            self::HAZMAT_UNIT => 'Hazmat Unit',
            self::SWAT_TEAM => 'SWAT Team',
            self::OTHER => 'Other',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::AMBULANCE => 'text-red-500',
            self::FIRE_ENGINE => 'text-orange-500',
            self::POLICE_UNIT => 'text-blue-500',
            self::EMS_UNIT => 'text-green-500',
            self::HELICOPTER => 'text-yellow-500',
            self::K9_UNIT => 'text-purple-500',
            self::TOW_TRUCK => 'text-gray-500',
            self::HAZMAT_UNIT => 'text-lime-500',
            self::SWAT_TEAM => 'text-black',
            self::OTHER => 'text-slate-500',
        };
    }
}
