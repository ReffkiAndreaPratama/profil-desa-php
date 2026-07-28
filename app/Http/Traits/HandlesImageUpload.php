<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesImageUpload
{
    /**
     * Handle foto field: prioritize uploaded file over URL input.
     * Returns the final foto value (Storage path or URL string).
     *
     * @param  Request      $request
     * @param  string       $folder   e.g. 'berita', 'galeri'
     * @param  string|null  $oldFoto  existing value to delete if replaced
     * @return string|null
     */
    protected function handleFoto(Request $request, string $folder, ?string $oldFoto = null): ?string
    {
        // Priority 1: uploaded file
        if ($request->hasFile('foto_upload') && $request->file('foto_upload')->isValid()) {
            // Delete old file if it was stored locally
            if ($oldFoto && Str::startsWith($oldFoto, 'uploads/')) {
                Storage::disk('public')->delete($oldFoto);
            }

            $file = $request->file('foto_upload');
            $path = $file->store("uploads/{$folder}", 'public');
            return $path; // e.g. "uploads/berita/abc123.jpg"
        }

        // Priority 2: URL input (keep existing if empty)
        $url = $request->input('foto');
        if ($url) {
            // If switching from uploaded file to URL, delete old file
            if ($oldFoto && Str::startsWith($oldFoto, 'uploads/')) {
                Storage::disk('public')->delete($oldFoto);
            }
            return $url;
        }

        // Nothing changed — keep old value
        return $oldFoto;
    }

    /**
     * Get the display URL for a foto value.
     * Handles both Storage paths and external URLs.
     */
    public static function fotoUrl(?string $foto): ?string
    {
        if (!$foto) return null;

        if (Str::startsWith($foto, ['http://', 'https://'])) {
            return $foto;
        }

        return Storage::disk('public')->url($foto);
    }
}
