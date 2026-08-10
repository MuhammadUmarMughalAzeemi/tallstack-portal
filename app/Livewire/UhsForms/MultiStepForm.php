<?php

namespace App\Livewire\UhsForms;

use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class MultiStepForm extends Component
{
    use Interactions;
    use WithFileUploads;

    public int $currentStep = 1;

    public array $steps = [
        1 => ['name' => 'Category & Program', 'icon' => 'tag', 'completed' => false],
        2 => ['name' => 'Personal Info', 'icon' => 'user', 'completed' => false],
        3 => ['name' => 'Qualifications', 'icon' => 'academic-cap', 'completed' => false],
        4 => ['name' => 'Admission Test', 'icon' => 'clipboard-document-check', 'completed' => false],
        5 => ['name' => 'Preferences', 'icon' => 'building-library', 'completed' => false],
        6 => ['name' => 'Documents', 'icon' => 'cloud-arrow-up', 'completed' => false],
        7 => ['name' => 'Review', 'icon' => 'clipboard-document-list', 'completed' => false],
        8 => ['name' => 'Submit', 'icon' => 'check-circle', 'completed' => false],
    ];

    public array $formData = [
        1 => [],
        2 => [],
        3 => [],
        4 => [],
        5 => [],
        6 => [],
        7 => [],
        8 => [],
    ];

    protected $listeners = [
        'completeStep' => 'handleCompleteStep',
        'goToStep' => 'goToStep',
    ];

    public function handleCompleteStep($stepKey): void
    {
        if (is_numeric($stepKey)) {
            $stepNum = (int) $stepKey;
            $this->steps[$stepNum]['completed'] = true;
        } else {
            // Map legacy step strings e.g. 'step1Completed'
            $map = [
                'step1Completed' => 1,
                'step2Completed' => 2,
                'step3Completed' => 3,
                'step4Completed' => 4,
                'step5Completed' => 5,
                'step6Completed' => 6,
                'step7Completed' => 7,
                'step8Completed' => 8,
            ];
            if (isset($map[$stepKey])) {
                $this->steps[$map[$stepKey]]['completed'] = true;
            }
        }
    }

    public function goToStep(int $step): void
    {
        if ($step >= 1 && $step <= 8) {
            $this->currentStep = $step;
        }
    }

    public function isAllCompleted(): bool
    {
        for ($i = 1; $i <= 7; $i++) {
            if (! $this->steps[$i]['completed']) {
                return false;
            }
        }

        return true;
    }

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (! $user) {
            return;
        }

        if (! blank($user->seatCategories)) {
            $this->steps[1]['completed'] = true;
        }
        if ($user->personalDetails) {
            $this->steps[2]['completed'] = true;
        }
        if ($user->qualifications) {
            $this->steps[3]['completed'] = true;
        }
        if ($user->admissionTest) {
            $this->steps[4]['completed'] = true;
        }
        if (! blank($user->mphillPhdSubjects) || $user->training_program_id) {
            $this->steps[5]['completed'] = true;
        }
        if ($user->userCnic || $user->userColorPhoto) {
            $this->steps[6]['completed'] = true;
        }
        if ($user->accepted_terms_and_conditions) {
            $this->steps[7]['completed'] = true;
        }
        if ($user->submitted_at) {
            $this->steps[8]['completed'] = true;
        }

        $this->currentStep = 1;
    }

    public function render()
    {
        return view('livewire.uhs-forms.multi-step-form')
            ->layout('layouts.uhs-form');
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login');
    }
}
