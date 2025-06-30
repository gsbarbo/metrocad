<?php

namespace App\Support\Civilian;

class HeightOptions
{
    public static function imperial(): array
    {
        return [
            48 => '4\'0"',
            49 => '4\'1"',
            50 => '4\'2"',
            51 => '4\'3"',
            52 => '4\'4"',
            53 => '4\'5"',
            54 => '4\'6"',
            55 => '4\'7"',
            56 => '4\'8"',
            57 => '4\'9"',
            58 => '4\'10"',
            59 => '4\'11"',
            60 => '5\'0"',
            61 => '5\'1"',
            62 => '5\'2"',
            63 => '5\'3"',
            64 => '5\'4"',
            65 => '5\'5"',
            66 => '5\'6"',
            67 => '5\'7"',
            68 => '5\'8"',
            69 => '5\'9"',
            70 => '5\'10"',
            71 => '5\'11"',
            72 => '6\'0"',
            73 => '6\'1"',
            74 => '6\'2"',
            75 => '6\'3"',
            76 => '6\'4"',
            77 => '6\'5"',
            78 => '6\'6"',
            79 => '6\'7"',
            80 => '6\'8"',
            81 => '6\'9"',
            82 => '6\'10"',
            83 => '6\'11"',
        ];
    }

    public static function metric(): array
    {
        return [
            48 => '122 cm',
            49 => '124 cm',
            50 => '127 cm',
            51 => '130 cm',
            52 => '132 cm',
            53 => '135 cm',
            54 => '137 cm',
            55 => '140 cm',
            56 => '142 cm',
            57 => '145 cm',
            58 => '147 cm',
            59 => '150 cm',
            60 => '152 cm',
            61 => '155 cm',
            62 => '157 cm',
            63 => '160 cm',
            64 => '163 cm',
            65 => '165 cm',
            66 => '168 cm',
            67 => '170 cm',
            68 => '173 cm',
            69 => '175 cm',
            70 => '178 cm',
            71 => '180 cm',
            72 => '183 cm',
            73 => '185 cm',
            74 => '188 cm',
            75 => '190 cm',
            76 => '193 cm',
            77 => '196 cm',
            78 => '198 cm',
            79 => '201 cm',
            80 => '203 cm',
            81 => '206 cm',
            82 => '208 cm',
            83 => '211 cm',
        ];
    }

    public static function getHeight(int $height): string
    {
        if (get_setting('use_metric_system', 0)) {
            return self::metric()[$height];
        } else {
            return self::imperial()[$height];
        }
    }

    public static function getList(): array
    {
        if (get_setting('use_metric_system', 0)) {
            return self::metric();
        } else {
            return self::imperial();
        }
    }
}
