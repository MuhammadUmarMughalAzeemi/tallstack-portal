<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\UserPersonalInfo;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class PersonalInfo extends Component
{
    use Interactions;

    public $full_name;
    public $email;
    public $phone;

    public function mount($data)
    {
        $this->full_name = $data['full_name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->phone = $data['phone'] ?? '';
    }

    public function save()
    {
        try {
            $this->validate([
                'full_name' => ['required', 'string', 'min:3', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['required', 'string', 'min:10', 'max:20'],
            ]);
        } catch (ValidationException $e) {
            $this->dialog()->error(__('Validation Error'), __('Please correct the highlighted fields before continuing.'))->send();
            $this->dispatch('validationFailed');

            throw $e;
        }

        $data = [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        UserPersonalInfo::updateOrCreate(['user_id' => auth()->id()], $data);

        $this->dispatch('step-completed', step: 1, data: $data);
        $this->toast()->success('Step 1: Personal Info saved.')->send();
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.personal-info');
    }
}
