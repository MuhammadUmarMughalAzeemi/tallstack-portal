<?php

namespace App\Livewire\UhsForms;

use Livewire\Component;

class ApplicationStatus extends Component
{
    public function render()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->load([
            'personalDetails',
            'qualifications',
            'admissionTest',
            'seatCategories',
            'mphillPhdSubjects',
        ]);

        return view('livewire.uhs-forms.application-status', [
            'user' => $user,
        ])->layout('layouts.uhs-form');
    }
}
