<?php

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
