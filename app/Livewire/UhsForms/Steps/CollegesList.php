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

    // UI Style selector
    public string $uiStyle = 'grid';

    // PhD: single selection
    public ?string $selectPhdSubject = null;

    // MPhil: multiple selection
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
            $this->selectMphilSubject  = $subjects->where('seat_category_id', $this->mphilId)->pluck('subject')->toArray();
            $this->selectMasterSubject = $subjects->where('seat_category_id', $this->masterId)->first()?->subject;
        }
    }

    public function reorderMphil(array $order): void
    {
        // Reorder the selectMphilSubject array based on dragged order
        $this->selectMphilSubject = collect($order)
            ->filter(fn ($name) => in_array($name, $this->selectMphilSubject))
            ->values()
            ->toArray();
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

        $inserts = [];

        if ($this->seatCategoryId === $this->phdId && $this->selectPhdSubject) {
            $inserts[] = ['user_id' => $userId, 'subject' => $this->selectPhdSubject, 'seat_category_id' => $this->phdId];
        }

        if ($this->seatCategoryId === $this->mphilId) {
            foreach ($this->selectMphilSubject as $subject) {
                $inserts[] = ['user_id' => $userId, 'subject' => $subject, 'seat_category_id' => $this->mphilId];
            }
        }

        if ($this->seatCategoryId === $this->masterId && $this->selectMasterSubject) {
            $inserts[] = ['user_id' => $userId, 'subject' => $this->selectMasterSubject, 'seat_category_id' => $this->masterId];
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
