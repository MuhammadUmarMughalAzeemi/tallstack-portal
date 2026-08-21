<?php

namespace App\Livewire\UhsForms\Steps;

use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Review extends Component
{
    use Interactions;

    public $allData;

    public function mount($allData)
    {
        $this->allData = $allData;
    }

    public function back()
    {
        $this->dispatch('go-to-step', step: 6);
    }

    public function save()
    {
        $this->dispatch('step-completed', step: 7, data: []);
        $this->toast()->timeout(3)->success('Step 7: Final review acknowledged.')->send();
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.review');
    }
}
