<?php

namespace App\Enum\User;

enum UserStatuses
{
    const USER_STATUSES = [
        1 => 'Pending User',
        2 => 'Member',
        3 => 'Suspended',
        4 => 'Banned',
        5 => 'Former Member',
        6 => 'Denied User',
    ];
}
