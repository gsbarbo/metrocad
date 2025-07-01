<?php

namespace App\Enum;

use App\Interface\StatusEnumInterface;

enum CivilianStatuses: int implements StatusEnumInterface
{
    case ALIVE = 1;

    case WANTED = 2;

    case JAILED = 3;

    case DEAD = 4;

    case HOSPITALIZED = 5;

    public function name(): string
    {
        return match ($this) {
            self::ALIVE => 'Alive',
            self::WANTED => 'Wanted',
            self::JAILED => 'Jailed',
            self::DEAD => 'Deceased',
            self::HOSPITALIZED => 'Hospitalized',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ALIVE => 'green',
            self::WANTED => 'red',
            self::JAILED => 'red',
            self::DEAD => 'red',
            self::HOSPITALIZED => 'yellow',
        };
    }
}
