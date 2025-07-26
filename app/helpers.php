<?php

if (! function_exists('get_setting')) {
    function get_setting(string $setting_name, string|int $default = '')
    {
        $settings = [];
        $settings = app('settings');

        foreach ($settings as $setting) {
            if ($setting->value == 'on' || $setting->value == 'yes' || $setting->value == 'off' || $setting->value == 'no' || $setting->value == '1' || $setting->value == '0') {
                $settings[$setting->name] = filter_var($setting->value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            } else {
                $settings[$setting->name] = $setting->value;
            }
        }

        if (! isset($settings[$setting_name])) {
            return $default;
        }

        if (empty($settings[$setting_name])) {
            return $default;
        }

        return $settings[$setting_name];
    }
}

if (! function_exists('markdown')) {
    function markdown(string $markdown)
    {
        return str()->markdown($markdown, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }
}

if (! function_exists('generateRandomString')) {
    function generateRandomString(int $length = 10, bool $upperLetters = true, bool $lowerLetters = true, bool $numbers = true)
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

        $key = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

        return $key;
    }
}
