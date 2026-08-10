<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\UserPreference;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Preferences extends Component
{
    use Interactions;

    public $program;
    public $study_mode;
    public $campus;

    public function mount($data)
    {
        $this->program = $data['program'] ?? '';
        $this->study_mode = $data['study_mode'] ?? '';
        $this->campus = $data['campus'] ?? '';
    }

    public function back()
    {
        $this->dispatch('go-to-step', step: 5);
    }

    public function save()
    {
        $this->validate([
            'program' => ['required', 'string'],
            'study_mode' => ['required', 'string'],
            'campus' => ['required', 'string'],
        ]);

        $data = [
            'program' => $this->program,
            'study_mode' => $this->study_mode,
            'campus' => $this->campus,
        ];

        UserPreference::updateOrCreate(['user_id' => auth()->id()], $data);

        $this->dispatch('step-completed', step: 6, data: $data);
        $this->toast()->success('Step 6: Preferences saved.')->send();
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.preferences');
    }
}
