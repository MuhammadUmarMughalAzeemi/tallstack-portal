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
    /**
     * Mapping of standard media collection names to clean file names on disk.
     */
    public const COLLECTION_FILENAME_MAP = [
        User::MEDIA_CNIC                    => 'cnic',
        User::MEDIA_CNIC_BACK               => 'cnic_backside',
        User::MEDIA_FATHER_CNIC             => 'father_cnic',
        User::MEDIA_FATHER_CNIC_BACK        => 'father_cnic_backside',
        User::MEDIA_PHOTO                   => 'photo',
        User::MEDIA_SIGNATURE               => 'signature',
        User::MEDIA_DOMICILE                => 'domicile',
        User::MEDIA_MATRIC_TRANSCRIPT       => 'matric_transcript',
        User::MEDIA_INTERMEDIATE_TRANSCRIPT => 'intermediate_transcript',
        User::MEDIA_MDCAT_RESULT            => 'mdcat_result',
    ];

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
        $fileName = $this->determineFileName($collection, $file);

        return $this->user
            ->addMedia($file->getRealPath())
            ->usingFileName($fileName)
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

        $fileName = $this->determineOtherFileName($file, $docName);

        return $this->user
            ->addMedia($file->getRealPath())
            ->usingFileName($fileName)
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
     * Determine the clean file name for a standard collection.
     * E.g. 'cnic.jpg', 'cnic_backside.png', 'father_cnic.jpg', etc.
     */
    public function determineFileName(string $collection, TemporaryUploadedFile $file): string
    {
        $baseName = self::COLLECTION_FILENAME_MAP[$collection] ?? str($collection)->slug('_')->toString();
        $ext      = $file->getClientOriginalExtension() ?: ($file->extension() ?: 'jpg');

        return "{$baseName}.{$ext}";
    }

    /**
     * Determine the clean file name for an other-document item.
     * E.g. 'experience_certificate.pdf', 'noc.jpg', etc.
     */
    public function determineOtherFileName(TemporaryUploadedFile $file, string $docName): string
    {
        $slug = str($docName)->slug('_')->limit(40)->toString();
        if (empty($slug)) {
            $slug = 'other_document';
        }
        $ext = $file->getClientOriginalExtension() ?: ($file->extension() ?: 'jpg');

        return "{$slug}.{$ext}";
    }
}
