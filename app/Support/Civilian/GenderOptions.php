<?php

namespace App\Support\Civilian;

class GenderOptions
{
    public static function getList(): array
    {
        return [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other',
        ];
    }

    public static function getGender(string $gender): string
    {
        return self::getList()[$gender];
    }
}
