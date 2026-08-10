<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\UserDocument;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Documents extends Component
{
    use Interactions;
    use WithFileUploads;

    public $id_proof;
    public $transcript;
    public $id_metadata;
    public $transcript_metadata;

    public function mount($data)
    {
        $this->id_metadata = $data['id_metadata'] ?? 'Pending';
        $this->transcript_metadata = $data['transcript_metadata'] ?? 'Pending';
    }

    public function back()
    {
        $this->dispatch('go-to-step', step: 4);
    }

    public function save()
    {
        $this->validate([
            'id_proof' => 'required|image|max:2048', // 2MB Max
            'transcript' => 'required|mimes:pdf,jpg,png|max:5120', // 5MB Max
        ], [], [
            'id_proof' => 'identity proof',
            'transcript' => 'academic transcript',
        ]);

        $idPath = $this->id_proof->store('documents/ids', 'public');
        $transcriptPath = $this->transcript->store('documents/transcripts', 'public');

        $this->id_metadata = 'Uploaded: ' . basename($idPath);
        $this->transcript_metadata = 'Uploaded: ' . basename($transcriptPath);

        $data = [
            'id_metadata' => $this->id_metadata,
            'transcript_metadata' => $this->transcript_metadata,
        ];

        // Update document record with paths AND metadata
        UserDocument::updateOrCreate(['user_id' => auth()->id()], [
            'id_proof_path' => $idPath,
            'transcript_path' => $transcriptPath,
            'id_metadata' => $this->id_metadata,
            'transcript_metadata' => $this->transcript_metadata,
        ]);

        $this->dispatch('step-completed', step: 5, data: $data);
        $this->toast()->success('Step 5: Documents uploaded successfully.')->send();
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.documents');
    }
}
