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
            \Log::error('Invalid content type', ['value' => $contentType]);

            return null;
        }

        $extension = explode('/', $contentType)[1]; // e.g., jpeg
        $filename = ($prefix ?? Str::random(8)).($override ? '' : '_'.time()).'.'.$extension;
        $path = rtrim($folder, '/').'/'.$filename;

        $result = Storage::disk('public')->put($path, $response->body());

        \Log::info('Image saved', [
            'path' => $path,
            'result' => $result,
            'url' => Storage::url($path),
        ]);

        return Storage::url($path);
    }

    public static function deleteFromUrl(string $url, string $path = '/'): void
    {
        Storage::disk('public')->delete(str_replace(asset($path), '', $url));
    }
}
