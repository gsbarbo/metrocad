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
