<?php

namespace App\Services;

use App\Models\User;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * UserMediaService
 *
 * Central place for all user document upload/retrieve operations.
 * Uses Spatie Media Library under the hood.
 *
 * Usage (in a Livewire component):
 *
 *   $service = new UserMediaService($user);
 *
 *   // Save / replace a single-file collection:
 *   $service->save(User::MEDIA_CNIC, $this->cnic);
 *
 *   // Save an other-document with a custom name:
 *   $service->saveOther($this->file, 'Experience Certificate');
 *
 *   // Get the public URL of a saved file (null if not uploaded yet):
 *   $url = $service->url(User::MEDIA_CNIC);
 *
 *   // Get all other-document Media records:
 *   $others = $service->otherDocuments();
 *
 *   // Delete a specific other-document by its media id:
 *   $service->deleteById($mediaId);
 *
 *   // Check if a collection has a file:
 *   $service->has(User::MEDIA_CNIC);
 */
class UserMediaService
{
    public function __construct(protected User $user)
    {
    }

    // ─── Save ───────────────────────────────────────────────────────────────

    /**
     * Save (or replace) a file into a single-file collection.
     *
     * @param  string                    $collection  One of User::MEDIA_* constants
     * @param  TemporaryUploadedFile     $file        Livewire temp upload
     * @return Media                                  The stored Spatie Media record
     */
    public function save(string $collection, TemporaryUploadedFile $file): Media
    {
        return $this->user
            ->addMedia($file->getRealPath())
            ->usingFileName($this->sanitizeFileName($file))
            ->usingName($collection)
            ->toMediaCollection($collection);
        // singleFile() defined on the collection auto-deletes the previous file
    }

    /**
     * Save an "other document" (multi-file collection) with a user-defined name.
     *
     * @param  TemporaryUploadedFile  $file
     * @param  string                 $docName  Custom label given by the user
     * @param  int|null               $replaceId  Media id to delete before adding (for "change")
     * @return Media
     */
    public function saveOther(TemporaryUploadedFile $file, string $docName, ?int $replaceId = null): Media
    {
        if ($replaceId) {
            $this->deleteById($replaceId);
        }

        return $this->user
            ->addMedia($file->getRealPath())
            ->usingFileName($this->sanitizeFileName($file))
            ->usingName($docName)
            ->toMediaCollection(User::MEDIA_OTHER_DOCUMENTS);
    }

    // ─── Retrieve ───────────────────────────────────────────────────────────

    /**
     * Get the public URL of the first file in a collection.
     * Returns null when nothing has been uploaded yet.
     */
    public function url(string $collection): ?string
    {
        $media = $this->user->getFirstMedia($collection);

        return $media?->getUrl();
    }

    /**
     * Get all other-document Media records for this user.
     *
     * @return \Illuminate\Support\Collection<Media>
     */
    public function otherDocuments(): \Illuminate\Support\Collection
    {
        return $this->user->getMedia(User::MEDIA_OTHER_DOCUMENTS);
    }

    /**
     * Check whether a collection already has a file.
     */
    public function has(string $collection): bool
    {
        return $this->user->hasMedia($collection);
    }

    // ─── Delete ─────────────────────────────────────────────────────────────

    /**
     * Delete a Media record by its id (used for other-documents removal).
     */
    public function deleteById(int $mediaId): void
    {
        $this->user
            ->media()
            ->where('id', $mediaId)
            ->first()
            ?->delete();
    }

    // ─── Helpers ────────────────────────────────────────────────────────────

    /**
     * Build a clean file name: userId_collection_originalName
     */
    private function sanitizeFileName(TemporaryUploadedFile $file): string
    {
        $original = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ext      = $file->getClientOriginalExtension();
        $slug     = str($original)->slug()->limit(40)->toString();

        return "{$this->user->id}_{$slug}.{$ext}";
    }
}
