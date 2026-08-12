<?php

namespace App\Livewire\UhsForms\Steps;

use Livewire\Component;

class StepOne extends Component
{
    // No public model properties — data is loaded fresh in render()
    // to avoid serializing large Eloquent objects into Livewire state on every request.

    public function editStep(int $stepNumber): void
    {
        $this->dispatch('goToStep', $stepNumber);
    }

    public function back(): void
    {
        $this->dispatch('goToStep', 6);
    }

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return view('livewire.uhs-forms.steps.step-one', [
            'user'              => $user,
            'personalDetails'   => $user?->personalDetails,
            'qualifications'    => $user?->qualifications,
            'admissionTest'     => $user?->admissionTest,
            'seatCategories'    => $user?->seatCategories->pluck('name')->toArray() ?? [],
            'mphillPhdSubjects' => $user?->mphillPhdSubjects ?? collect(),
        ]);
    }
}
