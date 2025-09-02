<?php

namespace App\Interface;

interface BaseEnumInterface
{
    public static function toArray(): array;

    public static function fromValue(string|int $value): ?self;

    public function color(string $type): ?string;

    public function label(): string;

    public function caseName(): string;
}
