<?php

if (! function_exists('get_setting')) {
    function get_setting($setting_name, $default = '')
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
