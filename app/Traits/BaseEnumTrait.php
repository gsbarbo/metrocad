<?php

namespace App\Traits;

trait BaseEnumTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->toArray();
    }

    public static function toSelectArray(): array
    {
        return collect(self::cases())
            ->map(fn (self $case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ])
            ->toArray();
    }

    public static function fromValue(string|int $value): ?self
    {
        return self::tryFrom($value);
    }

    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }

    public function caseName(): string
    {
        return $this->name;
    }

    public function is(self $case): bool
    {
        return $this === $case;
    }

    public function isNot(self $case): bool
    {
        return $this !== $case;
    }

    public function isIn(array $cases): bool
    {
        return in_array($this, $cases, strict: true);
    }
}
