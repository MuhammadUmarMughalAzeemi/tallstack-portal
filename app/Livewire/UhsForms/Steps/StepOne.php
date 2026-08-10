<?php

namespace App\Livewire\UhsForms\Steps;

use Livewire\Component;

class StepOne extends Component
{
    public $user;
    public $personalDetails;
    public $qualifications;
    public $admissionTest;
    public $seatCategories = [];
    public $mphillPhdSubjects;

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user) {
            $this->user = $user;
            $this->personalDetails = $user->personalDetails;
            $this->qualifications = $user->qualifications;
            $this->admissionTest = $user->admissionTest;
            $this->seatCategories = $user->seatCategories->pluck('name')->toArray();
            $this->mphillPhdSubjects = $user->mphillPhdSubjects;
        }
    }

    public function editStep(int $stepNumber): void
    {
        $this->dispatch('goToStep', $stepNumber);
    }

    public function confirmAndSubmit(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->update([
            'submitted_at' => now(),
            'accepted_terms_and_conditions' => true,
        ]);

        $this->dispatch('completeStep', 'step7Completed');
        $this->redirect(route('uhs-form-dashboard'));
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.step-one');
    }
}
