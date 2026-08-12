<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\Media;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class DocsAffidavit extends Component
{
    use Interactions;
    use WithFileUploads;

    public $cnic;
    public $cnicBackSide;
    public $fatherCnic;
    public $fatherCnicBackSide;
    public $signature;
    public $photo;
    public $domicileCertificate;
    public $matricTranscript;
    public $intermediateTranscript;
    public $mdcatResultCard;
    public $terms = false;

    protected function rules(): array
    {
        return [
            'terms' => 'accepted',
        ];
    }

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user) {
            $this->terms = (bool) $user->accepted_terms_and_conditions;
        }
    }

    private function uploadMedia($file, string $collection): void
    {
        if ($file && ! is_string($file)) {
            /** @var \App\Models\User $user */
            $user = auth()->user();
            $path = $file->store($user->id . '_images', 'public');

            Media::updateOrCreate(
                [
                    'mediaable_type' => get_class($user),
                    'mediaable_id'   => $user->id,
                    'collection'     => $collection,
                ],
                [
                    'name' => $collection,
                    'path' => $path,
                    'disk' => 'public',
                    'size' => $file->getSize(),
                ]
            );
        }
    }

    public function submit(): void
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dialog()->error(__('Validation Error'), __('Please correct the highlighted fields before continuing.'))->send();
            $this->dispatch('validationFailed');

            throw $e;
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->update([
            'accepted_terms_and_conditions' => $this->terms,
            'submitted_at' => now(),
        ]);

        $this->uploadMedia($this->cnic, 'userCnic');
        $this->uploadMedia($this->cnicBackSide, 'userCnicBackSide');
        $this->uploadMedia($this->fatherCnic, 'userFatherCnic');
        $this->uploadMedia($this->fatherCnicBackSide, 'userFatherCnicBackSide');
        $this->uploadMedia($this->signature, 'signature');
        $this->uploadMedia($this->photo, 'userColorPhoto');
        $this->uploadMedia($this->domicileCertificate, 'userDomicileCertificatePhoto');
        $this->uploadMedia($this->matricTranscript, 'userMatricTranscriptPhoto');
        $this->uploadMedia($this->intermediateTranscript, 'userIntermediateTranscriptPhoto');
        $this->uploadMedia($this->mdcatResultCard, 'userMdcatResultCardPhoto');

        $this->dispatch('completeStep', 'step6Completed');
        $this->dispatch('goToStep', 7);
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.docs-affidavit');
    }
}
