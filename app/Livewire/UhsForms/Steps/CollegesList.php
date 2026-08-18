<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\College;
use App\Models\MphillPhdSubjects;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class CollegesList extends Component
{
    use Interactions;

    // User's selected seat category (set in mount)
    public int $seatCategoryId = 0;
    public string $seatCategoryName = '';

    // PhD: single selection
    public ?string $selectPhdSubject = null;

    // MPhil: multiple selection (order = rank, index 0 is 1st preference)
    public array $selectMphilSubject = [];

    // Master: single selection
    public ?string $selectMasterSubject = null;

    public int $phdId    = 1;
    public int $mphilId  = 2;
    public int $masterId = 3;

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (! $user) {
            return;
        }

        // Get user's selected seat category from Step 1
        $category = $user->seatCategories->first();
        $this->seatCategoryId   = $category?->id ?? 0;
        $this->seatCategoryName = $category?->name ?? '';

        // Load previously saved preferences
        $subjects = $user->mphillPhdSubjects;
        if ($subjects && $subjects->isNotEmpty()) {
            $this->selectPhdSubject    = $subjects->where('seat_category_id', $this->phdId)->first()?->subject;
            $this->selectMphilSubject  = $subjects->where('seat_category_id', $this->mphilId)->sortBy('id')->pluck('subject')->values()->toArray();
            $this->selectMasterSubject = $subjects->where('seat_category_id', $this->masterId)->first()?->subject;
        }
    }

    public function togglePhd(int $collegeId): void
    {
        $name = $this->specialtyName($collegeId);
        if (! $name) {
            return;
        }

        $this->selectPhdSubject = $this->selectPhdSubject === $name ? null : $name;
    }

    public function toggleMaster(int $collegeId): void
    {
        $name = $this->specialtyName($collegeId);
        if (! $name) {
            return;
        }

        $this->selectMasterSubject = $this->selectMasterSubject === $name ? null : $name;
    }

    public function addMphil(int $collegeId): void
    {
        $name = $this->specialtyName($collegeId);
        if (! $name || in_array($name, $this->selectMphilSubject, true)) {
            return;
        }

        $this->selectMphilSubject[] = $name;
    }

    public function removeMphil(int $index): void
    {
        if (! isset($this->selectMphilSubject[$index])) {
            return;
        }

        unset($this->selectMphilSubject[$index]);
        $this->selectMphilSubject = array_values($this->selectMphilSubject);
    }

    public function clearMphil(): void
    {
        $this->selectMphilSubject = [];
    }

    public function moveMphilUp(int $index): void
    {
        if ($index < 1 || ! isset($this->selectMphilSubject[$index])) {
            return;
        }

        $this->swapMphil($index, $index - 1);
    }

    public function moveMphilDown(int $index): void
    {
        if (! isset($this->selectMphilSubject[$index], $this->selectMphilSubject[$index + 1])) {
            return;
        }

        $this->swapMphil($index, $index + 1);
    }

    public function reorderMphil(array $order): void
    {
        $valid = collect($order)
            ->filter(fn ($name) => in_array($name, $this->selectMphilSubject, true))
            ->unique()
            ->values();

        $missing = collect($this->selectMphilSubject)
            ->reject(fn ($name) => $valid->contains($name));

        $this->selectMphilSubject = $valid->concat($missing)->values()->toArray();
    }

    private function swapMphil(int $a, int $b): void
    {
        $items = $this->selectMphilSubject;
        [$items[$a], $items[$b]] = [$items[$b], $items[$a]];
        $this->selectMphilSubject = array_values($items);
    }

    private function specialtyName(int $collegeId): ?string
    {
        $name = College::query()
            ->where('id', $collegeId)
            ->where('seat_category_id', $this->seatCategoryId)
            ->value('name');

        return is_string($name) && $name !== '' ? $name : null;
    }

    public function back(): void
    {
        $this->dispatch('goToStep', 3);
    }

    public function submit(): void
    {
        // Validate based on seat category
        $hasSelection = match ($this->seatCategoryId) {
            $this->phdId    => ! empty($this->selectPhdSubject),
            $this->mphilId  => ! empty($this->selectMphilSubject),
            $this->masterId => ! empty($this->selectMasterSubject),
            default         => false,
        };

        if (! $hasSelection) {
            $this->toast()->error('Please select at least one specialty preference.')->send();
            $this->addError('preferences', 'Please select at least one specialty preference.');
            return;
        }

        /** @var \App\Models\User $user */
        $user   = auth()->user();
        $userId = $user->id;

        // Delete only this category's old preferences
        MphillPhdSubjects::where('user_id', $userId)
            ->where('seat_category_id', $this->seatCategoryId)
            ->delete();

        $now = now();
        $inserts = [];

        if ($this->seatCategoryId === $this->phdId && $this->selectPhdSubject) {
            $inserts[] = ['user_id' => $userId, 'subject' => $this->selectPhdSubject, 'seat_category_id' => $this->phdId, 'created_at' => $now, 'updated_at' => $now];
        }

        if ($this->seatCategoryId === $this->mphilId) {
            foreach ($this->selectMphilSubject as $subject) {
                $inserts[] = ['user_id' => $userId, 'subject' => $subject, 'seat_category_id' => $this->mphilId, 'created_at' => $now, 'updated_at' => $now];
            }
        }

        if ($this->seatCategoryId === $this->masterId && $this->selectMasterSubject) {
            $inserts[] = ['user_id' => $userId, 'subject' => $this->selectMasterSubject, 'seat_category_id' => $this->masterId, 'created_at' => $now, 'updated_at' => $now];
        }

        if (! empty($inserts)) {
            MphillPhdSubjects::insert($inserts);
        }

        $this->dispatch('completeStep', 'step5Completed');
        $this->dispatch('goToStep', 6);
    }

    public function render()
    {
        // Load only the relevant colleges for the user's selected program
        $colleges = Cache::remember(
            "lookup_colleges_cat_{$this->seatCategoryId}",
            86400,
            fn () => College::where('seat_category_id', $this->seatCategoryId)->orderBy('name')->get()
        );

        return view('livewire.uhs-forms.steps.colleges-list', compact('colleges'));
    }
}
