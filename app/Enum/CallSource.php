<?php

namespace App\Enum;

enum CallSource: string
{
    case DISPATCH = 'DISPATCH';
    case CIVILIAN = 'CIVILIAN';
    case OFFICER = 'OFFICER';
    case CALL = '911 Call';

    case OTHER = 'OTHER';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

    public function code(): string
    {
        return $this->name;
    }
}
