<?php

namespace App\Services;

class LicenseService
{
    public static function generateLicenseNumber(string $format, ?string $prefix = null): string
    {
        $id = $prefix;
        $explodedFormat = str_split($format);

        foreach ($explodedFormat as $index => $value) {
            $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
            switch ($value) {
                case 'A':
                    $id .= $letters[rand(0, 25)];
                    break;
                case '#':
                    $id .= rand(0, 9);
                    break;

                default:
                    // code...
                    break;
            }
        }

        return $id;
    }
}
