<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\UserAddress;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Address extends Component
{
    use Interactions;

    public $address;
    public $city;
    public $postal_code;

    public function mount($data)
    {
        $this->address = $data['address'] ?? '';
        $this->city = $data['city'] ?? '';
        $this->postal_code = $data['postal_code'] ?? '';
    }

    public function back()
    {
        $this->dispatch('go-to-step', step: 1);
    }

    public function save()
    {
        $this->validate([
            'address' => ['required', 'string', 'min:5', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'min:4', 'max:15'],
        ]);

        $data = [
            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
        ];

        UserAddress::updateOrCreate(['user_id' => auth()->id()], $data);

        $this->dispatch('step-completed', step: 2, data: $data);
        $this->toast()->success('Step 2: Address details saved.')->send();
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.address');
    }
}
