<?php

namespace App\Support\Civilian;

class WeightOptions
{
    public static function getWeight(int $weight): string
    {
        if (get_setting('general.measurementUnits') == 'metric') {
            return self::metric()[$weight];
        } else {
            return self::imperial()[$weight];
        }
    }

    public static function metric(): array
    {
        return [
            90 => '41 kg',
            95 => '43 kg',
            100 => '45 kg',
            105 => '48 kg',
            110 => '50 kg',
            115 => '52 kg',
            120 => '54 kg',
            125 => '57 kg',
            130 => '59 kg',
            135 => '61 kg',
            140 => '63 kg',
            145 => '66 kg',
            150 => '68 kg',
            155 => '70 kg',
            160 => '73 kg',
            165 => '75 kg',
            170 => '77 kg',
            175 => '79 kg',
            180 => '82 kg',
            185 => '84 kg',
            190 => '86 kg',
            195 => '88 kg',
            200 => '91 kg',
            205 => '93 kg',
            210 => '95 kg',
            215 => '98 kg',
            220 => '100 kg',
            225 => '102 kg',
            230 => '104 kg',
            235 => '107 kg',
            240 => '109 kg',
            245 => '111 kg',
            250 => '113 kg',
            255 => '116 kg',
            260 => '118 kg',
            265 => '120 kg',
            270 => '122 kg',
            275 => '125 kg',
            280 => '127 kg',
            285 => '129 kg',
            290 => '132 kg',
            295 => '134 kg',
            300 => '136 kg',
            305 => '138 kg',
            310 => '141 kg',
            315 => '143 kg',
            320 => '145 kg',
            325 => '147 kg',
            330 => '150 kg',
            335 => '152 kg',
            340 => '154 kg',
            345 => '156 kg',
            350 => '159 kg',
            355 => '161 kg',
            360 => '163 kg',
            365 => '166 kg',
            370 => '168 kg',
            375 => '170 kg',
            380 => '172 kg',
            385 => '175 kg',
            390 => '177 kg',
            395 => '179 kg',
            400 => '181 kg',
        ];
    }

    public static function imperial(): array
    {
        return [
            90 => '90 lb',
            95 => '95 lb',
            100 => '100 lb',
            105 => '105 lb',
            110 => '110 lb',
            115 => '115 lb',
            120 => '120 lb',
            125 => '125 lb',
            130 => '130 lb',
            135 => '135 lb',
            140 => '140 lb',
            145 => '145 lb',
            150 => '150 lb',
            155 => '155 lb',
            160 => '160 lb',
            165 => '165 lb',
            170 => '170 lb',
            175 => '175 lb',
            180 => '180 lb',
            185 => '185 lb',
            190 => '190 lb',
            195 => '195 lb',
            200 => '200 lb',
            205 => '205 lb',
            210 => '210 lb',
            215 => '215 lb',
            220 => '220 lb',
            225 => '225 lb',
            230 => '230 lb',
            235 => '235 lb',
            240 => '240 lb',
            245 => '245 lb',
            250 => '250 lb',
            255 => '255 lb',
            260 => '260 lb',
            265 => '265 lb',
            270 => '270 lb',
            275 => '275 lb',
            280 => '280 lb',
            285 => '285 lb',
            290 => '290 lb',
            295 => '295 lb',
            300 => '300 lb',
            305 => '305 lb',
            310 => '310 lb',
            315 => '315 lb',
            320 => '320 lb',
            325 => '325 lb',
            330 => '330 lb',
            335 => '335 lb',
            340 => '340 lb',
            345 => '345 lb',
            350 => '350 lb',
            355 => '355 lb',
            360 => '360 lb',
            365 => '365 lb',
            370 => '370 lb',
            375 => '375 lb',
            380 => '380 lb',
            385 => '385 lb',
            390 => '390 lb',
            395 => '395 lb',
            400 => '400 lb',
        ];
    }

    public static function getList(): array
    {
        if (get_setting('general.measurementUnits') == 'metric') {
            return self::metric();
        } else {
            return self::imperial();
        }
    }
}
