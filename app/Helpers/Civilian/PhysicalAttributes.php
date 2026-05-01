<?php

namespace App\Helpers\Civilian;

class PhysicalAttributes
{
    /**
     * @return array<int, string>
     */
    public static function heights(string $units = 'imperial'): array
    {
        return $units === 'metric' ? self::heightsMetric() : self::heightsImperial();
    }

    /**
     * @return array<int, string>
     */
    public static function weights(string $units = 'imperial'): array
    {
        return $units === 'metric' ? self::weightsMetric() : self::weightsImperial();
    }

    public static function formatHeight(int $inches, string $units = 'imperial'): string
    {
        if ($units === 'metric') {
            return round($inches * 2.54).' cm';
        }

        return intdiv($inches, 12)."'".($inches % 12).'"';
    }

    public static function formatWeight(int $lbs, string $units = 'imperial'): string
    {
        if ($units === 'metric') {
            return round($lbs * 0.453592).' kg';
        }

        return $lbs.' lb';
    }

    /**
     * @return array<int, string>
     */
    private static function heightsImperial(): array
    {
        $options = [];

        for ($inches = 48; $inches <= 83; $inches++) {
            $options[$inches] = intdiv($inches, 12)."'".($inches % 12).'"';
        }

        return $options;
    }

    /**
     * @return array<int, string>
     */
    private static function heightsMetric(): array
    {
        $options = [];

        for ($inches = 48; $inches <= 83; $inches++) {
            $options[$inches] = round($inches * 2.54).' cm';
        }

        return $options;
    }

    /**
     * @return array<int, string>
     */
    private static function weightsImperial(): array
    {
        $options = [];

        for ($lbs = 90; $lbs <= 400; $lbs += 5) {
            $options[$lbs] = $lbs.' lb';
        }

        return $options;
    }

    /**
     * @return array<int, string>
     */
    private static function weightsMetric(): array
    {
        $options = [];

        for ($lbs = 90; $lbs <= 400; $lbs += 5) {
            $options[$lbs] = round($lbs * 0.453592).' kg';
        }

        return $options;
    }
}
