<?php

namespace App\Enum;

use App\Interface\BaseEnumInterface;
use App\Traits\BaseEnumTrait;

enum CallSource: string implements BaseEnumInterface
{
    use BaseEnumTrait;

    case Dispatch = 'Dispatch';
    case Civilian = 'Civilian';
    case Officer = 'Officer';
    case Call = 'Call';
    case Other = 'Other';

    public function color(string $type): ?string
    {
        return null;
    }

    public function label(): string
    {
        return match ($this) {
            self::Dispatch => 'Dispatch',
            self::Civilian => 'Civilian',
            self::Officer => 'Officer',
            self::Call => '911 Call',
            self::Other => 'Other',
        };
    }
}
