<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\College;
use App\Models\MphillPhdSubjects;
use App\Models\SeatCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class CollegesList extends Component
{
    use Interactions;

    /** @var array<int, array{id: int, name: string, mode: string}> */
    public array $selectedPrograms = [];

    /** @var array<int|string, array<int, string>> */
    public array $preferencesByProgram = [];

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (! $user) {
            return;
        }

        $subjects = $user->mphillPhdSubjects;

        $this->selectedPrograms = $user->seatCategories
            ->map(fn (SeatCategory $category) => [
                'id'   => (int) $category->id,
                'name' => $category->name,
                'mode' => $category->usesRankedPreferences() ? 'ranked' : 'single',
            ])
            ->values()
            ->all();

        foreach ($this->selectedPrograms as $program) {
            $saved = $subjects
                ->where('seat_category_id', $program['id'])
                ->sortBy('id')
                ->pluck('subject')
                ->filter()
                ->values()
                ->all();

            if ($program['mode'] === 'single') {
                $saved = array_slice($saved, 0, 1);
            }

            $this->preferencesByProgram[$program['id']] = $saved;
        }
    }

    public function back(): void
    {
        $this->dispatch('goToStep', 3);
    }

    public function submit(): void
    {
        if ($this->selectedPrograms === []) {
            $this->toast()->error('Please go back to Step 1 and select a program first.')->send();
            $this->addError('preferences', 'Please select a program before choosing preferences.');

            return;
        }

        foreach ($this->selectedPrograms as $program) {
            if ($this->prefsFor((int) $program['id']) === []) {
                $this->toast()->error("Please add at least one specialty for {$program['name']}.")->send();
                $this->addError('preferences', "Please complete preferences for {$program['name']}.");

                return;
            }
        }

        /** @var \App\Models\User $user */
        $user   = auth()->user();
        $userId = $user->id;

        MphillPhdSubjects::where('user_id', $userId)->delete();

        $now     = now();
        $inserts = [];

        foreach ($this->selectedPrograms as $program) {
            $programId = (int) $program['id'];
            $items     = $this->prefsFor($programId);

            if ($program['mode'] === 'single') {
                $items = array_slice($items, 0, 1);
            }

            foreach ($items as $subject) {
                $inserts[] = [
                    'user_id'          => $userId,
                    'subject'          => $subject,
                    'seat_category_id' => $programId,
                    'created_at'       => $now,
                    'updated_at'       => $now,
                ];
            }
        }

        if ($inserts !== []) {
            MphillPhdSubjects::insert($inserts);
        }

        $this->dispatch('completeStep', 'step5Completed');
        $this->dispatch('goToStep', 6);
    }

    /**
     * @return array<int, string>
     */
    private function prefsFor(int $programId): array
    {
        $items = $this->preferencesByProgram[$programId]
            ?? $this->preferencesByProgram[(string) $programId]
            ?? [];

        return array_values(array_filter(
            $items,
            fn ($item) => $item !== ''
        ));
    }

    public function render()
    {
        $collegesByProgram = [];

        foreach ($this->selectedPrograms as $program) {
            $programId = (int) $program['id'];
            $collegesByProgram[$programId] = Cache::remember(
                "lookup_colleges_cat_{$programId}",
                86400,
                fn () => College::where('seat_category_id', $programId)->orderBy('name')->get(['id', 'name'])
            )->map(fn (College $college) => [
                'id'   => $college->id,
                'name' => $college->name,
            ])->values()->all();
        }

        $pickerConfig = [
            'activeId' => $this->selectedPrograms[0]['id'] ?? 0,
            'ranked'   => $this->preferencesByProgram,
            'programs' => collect($this->selectedPrograms)->map(fn (array $program) => [
                'id'       => $program['id'],
                'name'     => $program['name'],
                'mode'     => $program['mode'],
                'colleges' => $collegesByProgram[$program['id']] ?? [],
            ])->values()->all(),
        ];

        return view('livewire.uhs-forms.steps.colleges-list', compact('pickerConfig'));
    }
}
