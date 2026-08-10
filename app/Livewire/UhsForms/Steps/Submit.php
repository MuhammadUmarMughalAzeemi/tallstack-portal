<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\UserSubmission;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Submit extends Component
{
    use Interactions;

    public $declaration = false;
    public $isAllCompleted = false;

    public function mount($data = [], $isAllCompleted = true)
    {
        $this->declaration = $data['declaration'] ?? false;
        $this->isAllCompleted = $isAllCompleted;
    }

    public function back()
    {
        $this->dispatch('goToStep', 7);
    }

    public function submit()
    {
        $this->validate([
            'declaration' => ['accepted'],
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        UserSubmission::updateOrCreate(['user_id' => $user->id], [
            'declaration' => $this->declaration,
            'submitted_at' => now(),
        ]);

        $user->update([
            'submitted_at' => now(),
            'accepted_terms_and_conditions' => true,
        ]);

        $this->dispatch('completeStep', 'step8Completed');
        $this->redirect(route('uhs-form-dashboard'));
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.submit');
    }
}
