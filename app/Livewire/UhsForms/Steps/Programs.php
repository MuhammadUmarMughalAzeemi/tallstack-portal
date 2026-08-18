<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\MphillPhdSubjects;
use App\Models\PortalSetting;
use App\Models\Program;
use App\Models\SeatCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Programs extends Component
{
    use Interactions;

    public bool $allowMultiple = false;

    public $selectedSeatCategory;

    /** @var array<int, int|string> */
    public array $selectedSeatCategories = [];

    public $programPriority;
    public $pmdcNo;

    protected function rules(): array
    {
        if ($this->allowMultiple) {
            return [
                'selectedSeatCategories'   => 'required|array|min:1',
                'selectedSeatCategories.*' => 'integer|exists:seat_categories,id',
                'pmdcNo'                   => 'required|string',
            ];
        }

        return [
            'selectedSeatCategory' => 'required|integer|exists:seat_categories,id',
            'pmdcNo'               => 'required|string',
        ];
    }

    public function mount(): void
    {
        $this->allowMultiple = PortalSetting::current()->allowsMultiplePrograms();

        $user = auth()->user();
        if (! $user) {
            return;
        }

        $ids = $user->seatCategories->pluck('id')->map(fn ($id) => (int) $id)->values()->all();

        $this->selectedSeatCategories = $ids;
        $this->selectedSeatCategory   = $ids[0] ?? null;
        $this->programPriority        = $user->program_priority;
        $this->pmdcNo                 = $user->pmdc_pnmc;
    }

    public function submit(): void
    {
        $this->allowMultiple = PortalSetting::current()->allowsMultiplePrograms();

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dialog()->error(__('Validation Error'), __('Please correct the highlighted fields before continuing.'))->send();
            $this->dispatch('validationFailed');

            throw $e;
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $ids = $this->selectedProgramIds();

        $user->seatCategories()->sync($ids);
        $user->update([
            'program_id'       => $ids[0] ?? null,
            'program_priority' => 1,
            'pmdc_pnmc'        => $this->pmdcNo,
        ]);

        MphillPhdSubjects::where('user_id', $user->id)
            ->whereNotIn('seat_category_id', $ids)
            ->delete();

        $this->dispatch('completeStep', 'step1Completed');
        $this->dispatch('goToStep', 2);
    }

    /**
     * @return array<int, int>
     */
    private function selectedProgramIds(): array
    {
        if ($this->allowMultiple) {
            return collect($this->selectedSeatCategories)
                ->map(fn ($id) => (int) $id)
                ->filter()
                ->unique()
                ->values()
                ->all();
        }

        $id = (int) $this->selectedSeatCategory;

        return $id > 0 ? [$id] : [];
    }

    public function render()
    {
        $this->allowMultiple = PortalSetting::current()->allowsMultiplePrograms();

        $allSeatCategories = Cache::remember('lookup_seat_categories', 86400, fn () => SeatCategory::all());
        $allPrograms       = Cache::remember('lookup_programs', 86400, fn () => Program::all());

        return view('livewire.uhs-forms.steps.programs', compact('allSeatCategories', 'allPrograms'));
    }
}
