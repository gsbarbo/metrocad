<?php

namespace App\Services;

use App\Enums\SettingType;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    private array $normalized = [];

    public function __construct(private Collection $settings)
    {
        $this->normalize();
    }

    public function get(string $name, mixed $default = null): mixed
    {
        if (! $this->has($name)) {
            if ($default !== null) {
                return $default;
            }

            throw new \InvalidArgumentException("Setting '{$name}' does not exist.");
        }

        return $this->normalized[$name] ?? $default;
    }

    public function update(string|array $keyOrArray, mixed $value = null): void
    {
        $updates = is_array($keyOrArray) ? $keyOrArray : [$keyOrArray => $value];

        foreach ($updates as $key => $val) {
            $key = str_replace('_', '.', $key);

            if (($this->normalized[$key] ?? null) == $val) {
                continue;
            }

            Setting::where('name', $key)->update([
                'value' => $this->serialize($val, $this->getType($key)),
            ]);

            $this->normalized[$key] = $val;
        }

        Cache::forget('settings');
    }

    public function all(): array
    {
        return $this->normalized;
    }

    public function has(string $name): bool
    {
        return Arr::has($this->normalized, $name);
    }

    private function normalize(): void
    {
        foreach ($this->settings as $setting) {
            $value = is_array($setting) ? $setting['value'] : $setting->value;
            $type = is_array($setting) ? SettingType::from($setting['type']) : $setting->type;

            $this->normalized[$setting['name'] ?? $setting->name] = $this->cast($value, $type);
        }
    }

    private function cast(mixed $value, SettingType $type): mixed
    {
        return match ($type) {
            SettingType::Boolean => filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            SettingType::Integer => (int) $value,
            SettingType::Float => (float) $value,
            SettingType::Array => $this->castArray($value),
            SettingType::Json => $this->castJson($value),
            SettingType::String => $value,
            SettingType::Markdown => $value,
        };
    }

    private function castArray(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        return array_map('trim', explode(',', (string) $value));
    }

    private function castJson(mixed $value): mixed
    {
        if (! is_string($value)) {
            return $value;
        }

        $decoded = json_decode($value, associative: true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \UnexpectedValueException(
                "Setting could not be decoded as JSON: {$value}"
            );
        }

        return $decoded;
    }

    private function serialize(mixed $value, SettingType $type): string
    {
        return match ($type) {
            SettingType::Json => json_encode($value, JSON_THROW_ON_ERROR),
            SettingType::Array => is_array($value) ? implode(',', $value) : (string) $value,
            SettingType::Boolean => $value ? 'true' : 'false',
            default => (string) $value,
        };
    }

    private function getType(string $name): SettingType
    {
        $setting = $this->settings->firstWhere('name', $name);

        $type = is_array($setting) ? $setting['type'] : $setting?->type;

        if ($type instanceof SettingType) {
            return $type;
        }

        return $type ? SettingType::from($type) : SettingType::String;
    }
}
