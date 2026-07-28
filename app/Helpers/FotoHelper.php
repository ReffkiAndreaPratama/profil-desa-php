<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FotoHelper
{
    /**
     * Resolve a foto value to a displayable URL.
     * - External URLs (http/https) → returned as-is
     * - Storage paths (uploads/...)  → resolved via Storage::url()
     * - null / empty                 → returns $fallback or null
     */
    public static function url(?string $foto, ?string $fallback = null): ?string
    {
        if (!$foto) return $fallback;

        if (Str::startsWith($foto, ['http://', 'https://'])) {
            return $foto;
        }

        return Storage::disk('public')->url($foto);
    }
}
