<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\College;
use App\Models\MphillPhdSubjects;
use App\Models\TrainingProgram;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class CollegesList extends Component
{
    use Interactions;

    public $selectPhdSubject;
    public $selectMphilSubject = [];
    public $selectMasterSubject;
    public $selectDiplomaCertificateSubject;
    public array $selectTrainingPrograms = [];

    public int $phdId = 1;
    public int $mphilId = 2;
    public int $masterId = 3;
    public int $certificateId = 4;

    protected function rules(): array
    {
        return [
            // At least one preference must be selected across Mphil, Phd, Master, or Training Programs
        ];
    }

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user) {
            $subjects = $user->mphillPhdSubjects;
            if ($subjects) {
                $this->selectPhdSubject = $subjects->where('seat_category_id', $this->phdId)->first()?->subject;
                $this->selectMphilSubject = $subjects->where('seat_category_id', $this->mphilId)->pluck('subject')->toArray();
                $this->selectMasterSubject = $subjects->where('seat_category_id', $this->masterId)->first()?->subject;
                $this->selectDiplomaCertificateSubject = $subjects->where('seat_category_id', $this->certificateId)->first()?->subject;
            }

            if ($user->training_program_id) {
                $trainingData = json_decode($user->training_program_id, true);
                if (is_array($trainingData)) {
                    $this->selectTrainingPrograms = collect($trainingData)->pluck('name')->toArray();
                }
            }
        }
    }

    public function back(): void
    {
        $this->dispatch('goToStep', 4);
    }

    public function submit(): void
    {
        if (empty($this->selectMphilSubject) && empty($this->selectPhdSubject) && empty($this->selectMasterSubject) && empty($this->selectDiplomaCertificateSubject) && empty($this->selectTrainingPrograms)) {
            $this->toast()->error('Please select at least one program or specialty preference.')->send();
            $this->addError('preferences', 'Please select at least one program or specialty preference.');

            return;
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();
        $userId = $user->id;

        MphillPhdSubjects::where('user_id', $userId)->delete();

        if (! empty($this->selectMphilSubject)) {
            foreach ((array) $this->selectMphilSubject as $subjectName) {
                MphillPhdSubjects::create([
                    'user_id'          => $userId,
                    'subject'          => $subjectName,
                    'seat_category_id' => $this->mphilId,
                ]);
            }
        }

        if ($this->selectPhdSubject) {
            MphillPhdSubjects::create([
                'user_id'          => $userId,
                'subject'          => $this->selectPhdSubject,
                'seat_category_id' => $this->phdId,
            ]);
        }

        if ($this->selectMasterSubject) {
            MphillPhdSubjects::create([
                'user_id'          => $userId,
                'subject'          => $this->selectMasterSubject,
                'seat_category_id' => $this->masterId,
            ]);
        }

        if (! empty($this->selectTrainingPrograms)) {
            $data = [];
            $id = 1;
            foreach ($this->selectTrainingPrograms as $tp) {
                $data[] = ['id' => $id++, 'name' => $tp];
            }
            $user->update(['training_program_id' => json_encode($data)]);
        }

        $this->dispatch('completeStep', 'step5Completed');
        $this->dispatch('goToStep', 6);
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.colleges-list', [
            'phdColleges' => College::where('seat_category_id', 1)->get(),
            'mphilColleges' => College::where('seat_category_id', 2)->get(),
            'masterColleges' => College::where('seat_category_id', 3)->get(),
            'trainingPrograms' => TrainingProgram::all(),
        ]);
    }
}
