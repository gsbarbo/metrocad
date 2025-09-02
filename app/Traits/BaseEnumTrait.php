<?php

namespace App\Traits;

trait BaseEnumTrait
{
    public static function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->toArray();
    }

    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }

    public static function fromValue(string|int $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        return null;
    }

    public function caseName(): string
    {
        return $this->name;
    }
}
