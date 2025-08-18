<?php

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (! function_exists('get_setting')) {
    function get_setting(string $name): mixed
    {
        $settingsCollection = app('settings');

        static $normalized = null;
        if ($normalized === null) {
            $normalized = [];

            foreach ($settingsCollection as $setting) {
                $value = match ($setting->type) {
                    'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
                    'integer' => (int) $setting->value,
                    default => $setting->value,
                };

                $normalized[$setting->name] = $value;
            }
        }

        if (! Arr::has($normalized, $name)) {
            throw new \InvalidArgumentException("Setting '{$name}' does not exist.");
        }

        return Arr::get($normalized, $name);
    }
}

if (! function_exists('update_setting')) {
    function update_setting(string|array $keyOrArray, mixed $value = null): void
    {
        $updates = is_array($keyOrArray) ? $keyOrArray : [$keyOrArray => $value];

        foreach ($updates as $key => $val) {
            $key = str_replace('_', '.', $key);

            if (app('settings')->where('name', $key)->first()->value != $val) {
                $setting = Setting::where('name', $key)->first();
                $setting->update(['value' => $val]);
            }
        }

        Cache::forget('settings');
    }
}

if (! function_exists('markdown')) {
    function markdown(string $markdown): string
    {
        return str($markdown)->markdown([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }
}

if (! function_exists('getTableCache')) {
    function getTableCache(string $tableName): mixed
    {
        try {
            return Cache::rememberForever($tableName, function () use ($tableName) {
                return DB::table($tableName)->where('deleted_at', null)->get();
            });
        } catch (Throwable $th) {
            throw $th;
        }
    }
}

if (! function_exists('setTableCache')) {
    function setTableCache(string $tableName): mixed
    {
        try {
            Cache::forget($tableName);

            return Cache::rememberForever($tableName, function () use ($tableName) {
                return DB::table($tableName)->where('deleted_at', null)->get();
            });
        } catch (Throwable $th) {
            throw $th;
        }
    }
}

if (! function_exists('generate_random_string')) {
    function generate_random_string(int $length = 10, bool $upperLetters = true, bool $lowerLetters = true, bool $numbers = true): string
    {
        $upperLetterPool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowerLetterPool = 'abcdefghijklmnopqrstuvwxyz';
        $numberPool = '0123456789';
        $pool = '';

        if ($upperLetters) {
            $pool .= $upperLetterPool;
        }

        if ($lowerLetters) {
            $pool .= $lowerLetterPool;
        }

        if ($numbers) {
            $pool .= $numberPool;
        }

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
