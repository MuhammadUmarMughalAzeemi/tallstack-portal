<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\Program;
use App\Models\SeatCategory;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Programs extends Component
{
    use Interactions;

    public $seatCategories = [];
    public $programPriority;
    public $affirmation = 0;
    public $foreigner = 0;
    public $pmdcNo;

    protected function rules(): array
    {
        return [
            'seatCategories' => 'required|array|min:1',
            'affirmation'    => 'required|in:1',
            'pmdcNo'         => 'required|string',
        ];
    }

    public function mount(): void
    {
        $user = auth()->user();
        if ($user) {
            $this->seatCategories = $user->seatCategories->pluck('id')->toArray();
            $this->programPriority = $user->program_priority;
            $this->affirmation = $user->affirmation ?? 0;
            $this->foreigner = $user->foreigner ?? 0;
            $this->pmdcNo = $user->pmdc_pnmc;
        }
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

        $user->seatCategories()->sync($this->seatCategories);
        $user->update([
            'program_id'       => $this->seatCategories[0] ?? null,
            'program_priority' => 1,
            'affirmation'      => $this->affirmation,
            'foreigner'        => $this->foreigner,
            'pmdc_pnmc'        => $this->pmdcNo,
        ]);

        $this->dispatch('completeStep', 'step1Completed');
        $this->dispatch('goToStep', 2);
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.programs', [
            'allSeatCategories' => SeatCategory::all(),
            'allPrograms' => Program::all(),
        ]);
    }
}
