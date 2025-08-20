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

        \Log::info('contentType ImageService-SaveFromUrl', [
            'value' => $contentType,
        ]);

        if (! str_starts_with($contentType, 'image/')) {
            \Log::error('contentType error ImageService-SaveFromUrl', [
                'value' => $contentType,
            ]);

            return null;
        }

        $extension = explode('/', $contentType)[1]; // e.g., jpeg
        $filename = ($prefix ?? Str::random(8)).($override ? '' : '_'.time()).'.'.$extension;
        $path = rtrim($folder, '/').'/'.$filename;

        $result = Storage::disk('public')->put($path, $response->body());

        \Log::info('contentType ImageService-SaveFromUrl', [
            'extension' => $extension,
            'filename' => $filename,
            'path' => $path,
            'result' => $result,
            'url' => asset($path),
        ]);

        return asset($path);
    }

    public static function deleteFromUrl(string $url, string $path = '/'): void
    {
        Storage::disk('public')->delete(str_replace(asset($path), '', $url));
    }
}
