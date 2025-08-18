<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public static function saveFromUrl(string $url, string $folder = 'images', ?string $prefix = null, bool $override = true): ?string
    {
        $response = Http::get($url);
        $contentType = $response->header('Content-Type');

        if (! str_starts_with($contentType, 'image/')) {
            return null;
        }

        $extension = explode('/', $contentType)[1]; // e.g., jpeg
        $filename = ($prefix ?? Str::random(8)).($override ? '' : '_'.time()).'.'.$extension;
        $path = rtrim($folder, '/').'/'.$filename;

        Storage::disk('public')->put($path, $response->body());

        return asset($path);
    }
}
