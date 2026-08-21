<?php

namespace App\Livewire\UhsForms;

use Livewire\Component;

class UhsMainForm extends Component
{
    public int $step = 1;

    public bool $step1Active = true;
    public bool $step1Completed = false;

    public bool $step2Active = false;
    public bool $step2Completed = false;

    public bool $step3Active = false;
    public bool $step3Completed = false;

    public bool $step4Active = false;
    public bool $step4Completed = false;

    public bool $step5Active = false;
    public bool $step5Completed = false;

    public bool $step6Active = false;
    public bool $step6Completed = false;

    public bool $step7Active = false;
    public bool $step7Completed = false;

    protected $listeners = [
        'goToStep',
        'completeStep',
    ];

    public function goToStep(int $step): void
    {
        $this->resetAllActive();

        // Step 4 (Admission Test) is disabled for this project
        // If navigating to step 4, redirect to step 5 instead
        if ($step === 4) {
            $step = 5;
        }

        match ($step) {
            1 => $this->step1Active = true,
            2 => $this->step2Active = true,
            3 => $this->step3Active = true,
            5 => $this->step5Active = true,
            6 => $this->step6Active = true,
            7 => $this->step7Active = true,
            default => $this->step1Active = true,
        };

        $this->step = $step;
    }

    public function completeStep(string $step): void
    {
        $this->$step = true;

        if ($this->step7Completed) {
            $this->step7Active = false;
        }
    }

    public function mount(): void
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();
        if ($user) {
            if ($user->submitted_at) {
                $this->completeStep('step1Completed');
            } else {
                if ($user->program_priority || ! blank($user->seatCategories)) {
                    $this->completeStep('step1Completed');
                    $this->goToStep(2);
                }

                if ($user->personalDetails) {
                    $this->completeStep('step2Completed');
                    $this->goToStep(3);
                }

                if ($user->qualifications) {
                    $this->completeStep('step3Completed');
                    $this->completeStep('step4Completed'); // Auto-complete step 4 (bypassed)
                    $this->goToStep(5);
                }

                if ($user->admissionTest) {
                    // step4 is bypassed — kept for future use
                }

                if (! blank($user->mphillPhdSubjects)) {
                    $this->completeStep('step5Completed');
                    $this->goToStep(6);
                }

                if ($user->hasMedia(\App\Models\User::MEDIA_CNIC)) {
                    $this->completeStep('step6Completed');
                    $this->goToStep(7);
                }
            }
        }
    }

    private function resetAllActive(): void
    {
        $this->step1Active = false;
        $this->step2Active = false;
        $this->step3Active = false;
        $this->step4Active = false;
        $this->step5Active = false;
        $this->step6Active = false;
        $this->step7Active = false;
    }

    public function render()
    {
        return view('livewire.uhs-forms.uhs-main-form')
            ->layout('layouts.uhs-form');
    }
}
