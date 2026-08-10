<?php

namespace App\Livewire\UhsForms;

use App\Models\Media;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use WithFileUploads;

    public $challan;
    public $personalDetails;
    public $challanSubmitted = false;
    public $challanStatus = false;

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user) {
            $this->personalDetails = $user->personalDetails;
            $this->challanStatus = (bool) $user->is_paid;
        }
    }

    public function downloadChallan()
    {
        return redirect()->route('download.challan');
    }

    public function submitChallan(): void
    {
        if ($this->challan && ! is_string($this->challan)) {
            /** @var \App\Models\User $user */
            $user = auth()->user();
            $path = $this->challan->store($user->id . '_images', 'public');

            Media::updateOrCreate(
                [
                    'mediaable_type' => get_class($user),
                    'mediaable_id'   => $user->id,
                    'collection'     => 'userChallanImage',
                ],
                [
                    'name' => 'userChallanImage',
                    'path' => $path,
                    'disk' => 'public',
                    'size' => $this->challan->getSize(),
                ]
            );

            $this->challanSubmitted = true;
        }
    }

    public function render()
    {
        return view('livewire.uhs-forms.dashboard')
            ->layout('layouts.uhs-form');
    }
}
