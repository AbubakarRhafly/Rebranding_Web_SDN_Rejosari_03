<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class StorageFile
{
    /**
     * Resolve the public URL for a file path if it exists on disk.
     * Returns null if path is empty or file does not exist.
     */
    public static function url(?string $path): ?string
    {
        if ($path === null || trim($path) === '') {
            return null;
        }

        $cleanPath = ltrim(trim($path), '/');

        // Check if path is within public/images/ or public assets
        if (str_starts_with($cleanPath, 'images/') && ! str_contains($cleanPath, '..')) {
            if (is_file(public_path($cleanPath))) {
                return asset($cleanPath);
            }

            return null;
        }

        // Strip leading 'storage/' if someone saved it with 'storage/' prefix
        if (str_starts_with($cleanPath, 'storage/')) {
            $cleanPath = substr($cleanPath, 8);
        }

        // Check in public storage disk
        if (! str_contains($cleanPath, '..') && Storage::disk('public')->exists($cleanPath)) {
            return asset('storage/'.$cleanPath);
        }

        return null;
    }

    /**
     * Check whether a file path exists on disk.
     */
    public static function exists(?string $path): bool
    {
        return self::url($path) !== null;
    }
}
