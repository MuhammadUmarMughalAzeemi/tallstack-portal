<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\UserEducation;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Education extends Component
{
    use Interactions;

    public $degree;
    public $institution;
    public $graduation_year;
    public $cgpa;

    public function mount($data)
    {
        $this->degree = $data['degree'] ?? '';
        $this->institution = $data['institution'] ?? '';
        $this->graduation_year = $data['graduation_year'] ?? '';
        $this->cgpa = $data['cgpa'] ?? '';
    }

    public function back()
    {
        $this->dispatch('go-to-step', step: 2);
    }

    public function save()
    {
        try {
            $this->validate([
                'degree' => ['required', 'string', 'max:100'],
                'institution' => ['required', 'string', 'max:255'],
                'graduation_year' => ['required', 'numeric', 'min:1900', 'max:2030'],
                'cgpa' => ['required', 'numeric', 'min:0', 'max:4.0'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dialog()->error(__('Validation Error'), __('Please correct the highlighted fields before continuing.'))->send();
            $this->emit('validationFailed');

            throw $e;
        }

        $data = [
            'degree' => $this->degree,
            'institution' => $this->institution,
            'graduation_year' => $this->graduation_year,
            'cgpa' => $this->cgpa,
        ];

        UserEducation::updateOrCreate(['user_id' => auth()->id()], $data);

        $this->dispatch('step-completed', step: 3, data: $data);
        $this->toast()->success('Step 3: Education details saved.')->send();
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.education');
    }
}
