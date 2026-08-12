<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\UserExperience;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Experience extends Component
{
    use Interactions;

    public $job_title;
    public $company;
    public $years_experience;

    public function mount($data)
    {
        $this->job_title = $data['job_title'] ?? '';
        $this->company = $data['company'] ?? '';
        $this->years_experience = $data['years_experience'] ?? '';
    }

    public function back()
    {
        $this->dispatch('go-to-step', step: 3);
    }

    public function save()
    {
        try {
            $this->validate([
                'job_title' => ['required', 'string', 'max:100'],
                'company' => ['required', 'string', 'max:100'],
                'years_experience' => ['required', 'numeric', 'min:0', 'max:50'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dialog()->error(__('Validation Error'), __('Please correct the highlighted fields before continuing.'))->send();
            $this->emit('validationFailed');

            throw $e;
        }

        $data = [
            'job_title' => $this->job_title,
            'company' => $this->company,
            'years_experience' => $this->years_experience,
        ];

        UserExperience::updateOrCreate(['user_id' => auth()->id()], $data);

        $this->dispatch('step-completed', step: 4, data: $data);
        $this->toast()->success('Step 4: Professional experience saved.')->send();
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.experience');
    }
}
