<?php

namespace App\Services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class UserMediaPathGenerator implements PathGenerator
{
    /**
     * Get the path for the given media, relative to the root storage path.
     * Stores files in a directory named after the user's ID (e.g., "5/").
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    /**
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media) . '/responsive-images/';
    }

    /**
     * Get a base path for the given media.
     * Uses model_id (user ID) if available, falling back to media ID.
     */
    protected function getBasePath(Media $media): string
    {
        $prefix = config('media-library.prefix', '');

        $folder = $media->model_id ?? $media->getKey();

        if ($prefix !== '' && $prefix !== null) {
            return $prefix . '/' . $folder;
        }

        return (string) $folder;
    }
}
