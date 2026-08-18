<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\User;
use App\Services\UserMediaService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

/**
 * DocsAffidavit — Step 5 of the UHS postgraduate admission form.
 *
 * Each document field follows a simple two-property pattern:
 *   $<field>       — Livewire temp upload (TemporaryUploadedFile | null)
 *   $saved<Field>  — Public URL string once saved to Spatie media (null = not yet uploaded)
 *
 * Saving flow:
 *   1. User picks a file  → Livewire uploads to /tmp → $field becomes a TemporaryUploadedFile
 *   2. User clicks "Save" → saveSingleDocument($field) is called
 *                        → UserMediaService::save() stores file via Spatie
 *                        → $saved<Field> is set to the public URL
 *                        → $field is cleared back to null
 *   3. On submit          → any still-unsaved temp files are saved automatically
 *
 * Other Documents (user-defined name + file):
 *   Stored in the User::MEDIA_OTHER_DOCUMENTS multi-file collection.
 *   Each $otherDocuments entry: [id, docName, file, savedUrl, savedName]
 */
class DocsAffidavit extends Component
{
    use Interactions;
    use WithFileUploads;

    // ─── Standard document temp files ───────────────────────────────────────
    public $cnic;
    public $cnicBack;
    public $fatherCnic;
    public $fatherCnicBack;
    public $photo;
    public $signature;
    public $domicile;
    public $matricTranscript;
    public $intermediateTranscript;
    public $mdcatResult;

    // ─── Saved public URLs (populated in mount from Spatie) ─────────────────
    public ?string $savedCnic                    = null;
    public ?string $savedCnicBack                = null;
    public ?string $savedFatherCnic              = null;
    public ?string $savedFatherCnicBack          = null;
    public ?string $savedPhoto                   = null;
    public ?string $savedSignature               = null;
    public ?string $savedDomicile                = null;
    public ?string $savedMatricTranscript        = null;
    public ?string $savedIntermediateTranscript  = null;
    public ?string $savedMdcatResult             = null;

    // ─── Other documents ────────────────────────────────────────────────────
    // Each entry: ['id' => int|null, 'docName' => string, 'file' => null,
    //              'savedUrl' => string|null, 'savedName' => string|null]
    public array $otherDocuments = [];

    // ─── Other documents section enable/disable ─────────────────────────────
    // When true, at least one document is required
    public bool $otherDocumentsEnabled = false;

    // ─── Declaration checkbox ────────────────────────────────────────────────
    public bool $terms = false;

    // ─── Maps field name → User::MEDIA_* collection constant ────────────────
    // Used by saveSingleDocument() to avoid repetitive switch/case.
    private const FIELD_COLLECTION_MAP = [
        'cnic'                   => User::MEDIA_CNIC,
        'cnicBack'               => User::MEDIA_CNIC_BACK,
        'fatherCnic'             => User::MEDIA_FATHER_CNIC,
        'fatherCnicBack'         => User::MEDIA_FATHER_CNIC_BACK,
        'photo'                  => User::MEDIA_PHOTO,
        'signature'              => User::MEDIA_SIGNATURE,
        'domicile'               => User::MEDIA_DOMICILE,
        'matricTranscript'       => User::MEDIA_MATRIC_TRANSCRIPT,
        'intermediateTranscript' => User::MEDIA_INTERMEDIATE_TRANSCRIPT,
        'mdcatResult'            => User::MEDIA_MDCAT_RESULT,
    ];

    // Matching saved-URL property names (same order as FIELD_COLLECTION_MAP)
    private const FIELD_SAVED_MAP = [
        'cnic'                   => 'savedCnic',
        'cnicBack'               => 'savedCnicBack',
        'fatherCnic'             => 'savedFatherCnic',
        'fatherCnicBack'         => 'savedFatherCnicBack',
        'photo'                  => 'savedPhoto',
        'signature'              => 'savedSignature',
        'domicile'               => 'savedDomicile',
        'matricTranscript'       => 'savedMatricTranscript',
        'intermediateTranscript' => 'savedIntermediateTranscript',
        'mdcatResult'            => 'savedMdcatResult',
    ];

    // ─── Validation ─────────────────────────────────────────────────────────
    protected function rules(): array
    {
        $rules = [
            'terms' => 'accepted',
        ];

        // If otherDocumentsEnabled, ONLY first row becomes required
        // All other rows are completely optional (even if added)
        if ($this->otherDocumentsEnabled) {
            // Get first row
            $firstRow = $this->otherDocuments[0] ?? null;
            $isSaved = $firstRow && !empty($firstRow['savedUrl']);

            // First row is mandatory when section is enabled
            // But if already saved, don't require the temp file field
            if ($isSaved) {
                // Already saved, only validate that name exists (which it does)
                // No need to validate the empty file field
            } else {
                // Not saved yet, require both name and file
                $rules['otherDocuments.0.docName'] = 'required|string|min:3';
                $rules['otherDocuments.0.file'] = 'required';
            }

            // For any other rows: if user started filling (has docName or file), enforce both
            foreach ($this->otherDocuments as $index => $doc) {
                if ($index === 0) {
                    continue; // Already validated above
                }

                $hasName = !empty(trim($doc['docName'] ?? ''));
                $hasFile = !empty($doc['file']) && !is_string($doc['file']);
                $hasSaved = !empty($doc['savedUrl']);

                // If row has ANY data, enforce BOTH fields
                if ($hasName || $hasFile || $hasSaved) {
                    $rules["otherDocuments.{$index}.docName"] = 'required|string|min:3';

                    if (!$hasSaved) {
                        $rules["otherDocuments.{$index}.file"] = 'required';
                    }
                }
            }
        }

        return $rules;
    }

    // ─── Custom Messages ────────────────────────────────────────────────────
    protected function messages(): array
    {
        $messages = [
            'otherDocuments.0.docName.required' => 'Document name is required (1st document)',
            'otherDocuments.0.docName.min' => 'Document name must be at least 3 characters (1st document)',
            'otherDocuments.0.file.required' => 'Please upload a file (1st document)',
            'terms.accepted' => 'You must accept the declaration to proceed',
        ];

        // Add messages for all other rows dynamically
        foreach ($this->otherDocuments as $index => $doc) {
            if ($index === 0) {
                continue;
            }

            $rowNum = $index + 1;
            $messages["otherDocuments.{$index}.docName.required"] = "Document name is required ({$rowNum}nd document)";
            $messages["otherDocuments.{$index}.docName.min"] = "Document name must be at least 3 characters ({$rowNum}nd document)";
            $messages["otherDocuments.{$index}.file.required"] = "Please upload a file ({$rowNum}nd document)";
        }

        return $messages;
    }

    // ─── Mount ──────────────────────────────────────────────────────────────
    public function mount(): void
    {
        /** @var User $user */
        $user = auth()->user();
        if (! $user) {
            return;
        }

        $this->terms   = (bool) $user->accepted_terms_and_conditions;
        $mediaService  = new UserMediaService($user);

        // Load saved URLs for all standard documents
        foreach (self::FIELD_COLLECTION_MAP as $field => $collection) {
            $savedProp        = self::FIELD_SAVED_MAP[$field];
            $this->$savedProp = $mediaService->url($collection);
        }

        // Load saved other documents
        $others = $mediaService->otherDocuments();

        if ($others->isNotEmpty()) {
            foreach ($others as $media) {
                $this->otherDocuments[] = [
                    'id'        => $media->id,
                    'docName'   => $media->name,
                    'file'      => null,
                    'savedUrl'  => $media->getUrl(),
                    'savedName' => $media->name,
                ];
            }
            $this->otherDocumentsEnabled = true;
        } else {
            // Default: one empty row so UI is never blank
            $this->otherDocuments[] = $this->emptyOtherDocRow();
        }
    }

    // ─── Standard document actions ──────────────────────────────────────────

    /**
     * Called by the x-file-upload component "Save" button.
     * Saves one standard document and updates its saved URL property.
     */
    public function saveSingleDocument(string $field): void
    {
        if (! isset(self::FIELD_COLLECTION_MAP[$field])) {
            return;
        }

        $file = $this->$field;

        if (! $file || is_string($file)) {
            return;
        }

        /** @var User $user */
        $user       = auth()->user();
        $collection = self::FIELD_COLLECTION_MAP[$field];
        $savedProp  = self::FIELD_SAVED_MAP[$field];

        $media = (new UserMediaService($user))->save($collection, $file);

        $this->$savedProp = $media->getUrl();
        $this->$field     = null;

        $this->toast()->success('Saved', 'Document saved successfully.')->send();
    }

    // ─── Other documents actions ─────────────────────────────────────────────

    /** Add a new empty row to the other-documents list. */
    public function addOtherDocument(): void
    {
        $this->otherDocuments[] = $this->emptyOtherDocRow();
    }

    /**
     * Save an other-document row via UserMediaService.
     * Validates name + file before saving.
     */
    public function saveOtherDocument(int $index): void
    {
        $row     = $this->otherDocuments[$index] ?? null;
        $docName = trim($row['docName'] ?? '');
        $file    = $row['file'] ?? null;

        if (empty($docName)) {
            $this->addError("otherDocuments.{$index}.docName", 'Please enter a document name.');
            return;
        }

        if (! $file || is_string($file)) {
            $this->addError("otherDocuments.{$index}.file", 'Please choose a file to upload.');
            return;
        }

        /** @var User $user */
        $user = auth()->user();

        // Pass existing media id so service can replace it on "Change"
        $media = (new UserMediaService($user))->saveOther($file, $docName, $row['id'] ?? null);

        $this->otherDocuments[$index] = [
            'id'        => $media->id,
            'docName'   => $docName,
            'file'      => null,
            'savedUrl'  => $media->getUrl(),
            'savedName' => $docName,
        ];

        $this->toast()->success('Saved', "\"{$docName}\" saved successfully.")->send();
    }

    /**
     * Remove an other-document row.
     * If it was already saved, deletes the Spatie Media record too.
     */
    public function removeOtherDocument(int $index): void
    {
        $row = $this->otherDocuments[$index] ?? null;

        if ($row && ! empty($row['id'])) {
            /** @var User $user */
            $user = auth()->user();
            (new UserMediaService($user))->deleteById((int) $row['id']);
        }

        array_splice($this->otherDocuments, $index, 1);

        // Always keep at least one empty row
        if (empty($this->otherDocuments)) {
            $this->otherDocuments[] = $this->emptyOtherDocRow();
        }
    }

    // ─── Navigation ─────────────────────────────────────────────────────────

    public function back(): void
    {
        $this->dispatch('goToStep', 5);
    }

    // ─── Submit ─────────────────────────────────────────────────────────────

    public function submit(): void
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            // Build detailed error message from all validation errors
            $errorMessages = [];
            foreach ($e->validator->errors()->all() as $error) {
                $errorMessages[] = $error;
            }

            $errorText = count($errorMessages) > 1
                ? implode("\n", $errorMessages)
                : ($errorMessages[0] ?? 'Please check all required fields and try again.');

            $this->dialog()->error('Validation Error', $errorText)->send();
            $this->dispatch('validationFailed');
            throw $e;
        }

        /** @var User $user */
        $user = auth()->user();

        // Auto-save any remaining standard temp files
        foreach (array_keys(self::FIELD_COLLECTION_MAP) as $field) {
            if ($this->$field && ! is_string($this->$field)) {
                $this->saveSingleDocument($field);
            }
        }

        // Auto-save any remaining other-document temp files
        // Only rows with BOTH name + file are saved; empty rows are ignored
        foreach (array_keys($this->otherDocuments) as $index) {
            $row = $this->otherDocuments[$index];

            if (!empty($row['file']) && !is_string($row['file']) && !empty(trim($row['docName'] ?? ''))) {
                $this->saveOtherDocument($index);
            }
        }

        $user->update(['accepted_terms_and_conditions' => true]);

        $this->dispatch('completeStep', 'step6Completed');
        $this->dispatch('goToStep', 7);
    }

    // ─── Render ─────────────────────────────────────────────────────────────

    public function render()
    {
        return view('livewire.uhs-forms.steps.docs-affidavit');
    }

    // ─── Private helpers ────────────────────────────────────────────────────

    private function emptyOtherDocRow(): array
    {
        return ['id' => null, 'docName' => '', 'file' => null, 'savedUrl' => null, 'savedName' => null];
    }
}
