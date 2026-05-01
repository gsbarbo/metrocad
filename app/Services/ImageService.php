<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    private const ALLOWED_TYPES = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    private const MAX_BYTES = 5 * 1024 * 1024; // 5MB

    public function saveFromUrl(string $url, string $folder, string $filename, bool $unique = false): ImageResult
    {
        $response = Http::get($url);

        if ($response->failed()) {
            return ImageResult::fail("The image URL returned a {$response->status()} response.");
        }

        $contentType = strtolower(trim(explode(';', $response->header('Content-Type'))[0]));

        if (! isset(self::ALLOWED_TYPES[$contentType])) {
            return ImageResult::fail("The URL did not return an image (got {$contentType}).");
        }

        if (strlen($response->body()) > self::MAX_BYTES) {
            return ImageResult::fail('The image exceeds the 5MB size limit.');
        }

        $name = $unique ? $filename.'_'.Str::random(8) : $filename;
        $path = rtrim($folder, '/').'/'.$name.'.'.self::ALLOWED_TYPES[$contentType];

        if (! Storage::disk('public')->put($path, $response->body())) {
            return ImageResult::fail('The image could not be saved to disk.');
        }

        Log::info('Image saved', ['path' => $path]);

        return ImageResult::ok($path, Storage::disk('public')->url($path));
    }

    public function delete(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
