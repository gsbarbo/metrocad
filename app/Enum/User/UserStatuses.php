<?php

namespace App\Enum\User;

use App\Interface\StatusEnumInterface;

enum UserStatuses: int implements StatusEnumInterface
{
    case PENDING = 1;

    case MEMBER = 2;

    case SUSPENDED = 3;

    case BANNED = 4;

    case FORMER = 5;

    case DENIED = 6;

    public function name(): string
    {
        return match ($this) {
            self::PENDING => 'Pending User',
            self::MEMBER => 'Member',
            self::SUSPENDED => 'Suspended',
            self::BANNED => 'Banned',
            self::FORMER => 'Former Member',
            self::DENIED => 'Denied User',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'white',
            self::MEMBER => 'green',
            self::SUSPENDED => 'yellow',
            self::BANNED => 'red',
            self::FORMER => 'yellow',
            self::DENIED => 'red',
        };
    }
}
