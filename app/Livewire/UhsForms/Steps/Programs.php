<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\Program;
use App\Models\SeatCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Programs extends Component
{
    use Interactions;

    public $selectedSeatCategory;
    public $programPriority;
    public $pmdcNo;

    protected function rules(): array
    {
        return [
            'selectedSeatCategory' => 'required',
            'pmdcNo'               => 'required|string',
        ];
    }

    public function mount(): void
    {
        $user = auth()->user();
        if (! $user) {
            return;
        }

        $this->selectedSeatCategory = $user->seatCategories->first()?->id;
        $this->programPriority      = $user->program_priority;
        $this->pmdcNo               = $user->pmdc_pnmc;
    }

    public function submit(): void
    {
        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dialog()->error(__('Validation Error'), __('Please correct the highlighted fields before continuing.'))->send();
            $this->dispatch('validationFailed');

            throw $e;
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->seatCategories()->sync([$this->selectedSeatCategory]);
        $user->update([
            'program_id'       => $this->selectedSeatCategory,
            'program_priority' => 1,
            'pmdc_pnmc'        => $this->pmdcNo,
        ]);

        $this->dispatch('completeStep', 'step1Completed');
        $this->dispatch('goToStep', 2);
    }

    public function render()
    {
        // Cached — seat categories and programs never change at runtime
        $allSeatCategories = Cache::remember('lookup_seat_categories', 86400, fn () => SeatCategory::all());
        $allPrograms       = Cache::remember('lookup_programs', 86400, fn () => Program::all());

        return view('livewire.uhs-forms.steps.programs', compact('allSeatCategories', 'allPrograms'));
    }
}
