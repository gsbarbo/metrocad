<?php

use App\Services\SettingsService;

if (! function_exists('toast')) {
    function toast(string $type, string $message): void
    {
        $existing = session()->get('toast', []);

        if (isset($existing['message'])) {
            $existing = [$existing];
        }

        $existing[] = ['type' => $type, 'message' => $message];

        session()->flash('toast', $existing);
    }
}

if (! function_exists('setting')) {
    function setting(string $name, mixed $default = null): mixed
    {
        return app(SettingsService::class)->get($name, $default);
    }
}

if (! function_exists('update_setting')) {
    function update_setting(string|array $keyOrArray, mixed $value = null): void
    {
        app(SettingsService::class)->update($keyOrArray, $value);
    }
}
