<?php

namespace App\Services;

class ImageResult
{
    public readonly bool $ok;

    public readonly ?string $path;

    public readonly ?string $url;

    public readonly ?string $error;

    private function __construct(bool $ok, ?string $path, ?string $url, ?string $error)
    {
        $this->ok = $ok;
        $this->path = $path;
        $this->url = $url;
        $this->error = $error;
    }

    public static function ok(string $path, string $url): self
    {
        return new self(true, $path, $url, null);
    }

    public static function fail(string $error): self
    {
        return new self(false, null, null, $error);
    }
}
