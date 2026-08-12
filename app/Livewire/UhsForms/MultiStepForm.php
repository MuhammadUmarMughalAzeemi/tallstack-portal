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
        if ($step < 1 || $step > 8) {
            return;
        }

        if ($step < $this->currentStep) {
            $this->currentStep = $step;
            session()->put('uhs_form_current_step', $step);

            return;
        }

        $blockedStep = $this->getBlockedStep($step);

        if ($blockedStep !== null) {
            $this->currentStep = $blockedStep;
            session()->put('uhs_form_current_step', $blockedStep);

            return;
        }

        $this->currentStep = $step;
        session()->put('uhs_form_current_step', $step);
    }

    private function getBlockedStep(int $step): ?int
    {
        if ($step <= 1) {
            return null;
        }

        if (! ($this->steps[$step - 1]['completed'] ?? false)) {
            return $step - 1;
        }

        for ($i = 1; $i <= $step; $i++) {
            if (! ($this->steps[$i]['completed'] ?? false)) {
                return $i;
            }
        }

        return null;
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
        $this->currentStep = (int) session('uhs_form_current_step', 1);

        if ($this->currentStep < 1 || $this->currentStep > 8) {
            $this->currentStep = 1;
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (! $user) {
            session()->put('uhs_form_current_step', $this->currentStep);

            return;
        }

        // Evaluate actual DB completion for each step
        $this->steps[1]['completed'] = ! blank($user->seatCategories) && ! blank($user->pmdc_pnmc) && ((int)$user->affirmation === 1);
        
        $details = $user->personalDetails;
        $this->steps[2]['completed'] = $details && ! blank($details->mother_name) && ! blank($details->date_of_birth) && ! blank($details->gender_id) && ! blank($details->residence_area_id) && ! blank($details->address) && ! blank($details->nationality_id) && ! blank($details->city) && ! blank($details->country);

        $q = $user->qualifications;
        $this->steps[3]['completed'] = $q && ! blank($q->ssc_exam_passeds_id) && ! blank($q->hssc_exam_passeds_id) && ! blank($q->mbbs_exam_passeds_id);

        $test = $user->admissionTest;
        $this->steps[4]['completed'] = $test && (! blank($test->md_cat_obtained_marks) || ! blank($test->sat_biology_obtained_marks) || ! blank($test->ucat_obtained_marks) || ! blank($test->mcat_obtained_marks));

        $this->steps[5]['completed'] = ! blank($user->mphillPhdSubjects) || ! blank($user->training_program_id);

        $this->steps[6]['completed'] = (bool) $user->accepted_terms_and_conditions;

        $this->steps[7]['completed'] = (bool) $user->submitted_at;
        $this->steps[8]['completed'] = (bool) $user->submitted_at;

        $blockedStep = $this->getBlockedStep($this->currentStep);
        if ($blockedStep !== null) {
            $this->currentStep = $blockedStep;
        }

        session()->put('uhs_form_current_step', $this->currentStep);
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
