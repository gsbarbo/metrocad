<?php

namespace App\Enum;

use App\Interface\StatusEnumInterface;

enum CivilianStatus: int implements StatusEnumInterface
{
    case Alive = 1;

    case Wanted = 2;

    case Jailed = 3;

    case Dead = 4;

    case Hospitalized = 5;

    public function name(): string
    {
        return match ($this) {
            self::Alive => 'Alive',
            self::Wanted => 'Wanted',
            self::Jailed => 'Jailed',
            self::Dead => 'Deceased',
            self::Hospitalized => 'Hospitalized',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Alive => 'green',
            self::Wanted, self::Jailed, self::Dead => 'red',
            self::Hospitalized => 'yellow',
        };
    }
}
