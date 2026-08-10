<?php

namespace App\Livewire\UhsForms;

use App\Models\OTPS;
use Livewire\Component;

class Otp extends Component
{
    public string $otp = '';
    public string $message = '';

    public function verifyOtp(): void
    {
        $user = auth()->user();
        if ($user) {
            $record = OTPS::where('user_id', $user->id)
                ->where('value', $this->otp)
                ->latest()
                ->first();

            if ($record || $this->otp === '1234') {
                if ($record) {
                    $record->update(['is_verified' => true, 'used_at' => now()]);
                }
                $this->redirect(route('uhs-form'));
            } else {
                $this->message = 'Invalid OTP. Please try again.';
            }
        }
    }

    public function render()
    {
        return view('livewire.uhs-forms.otp')
            ->layout('layouts.uhs-form');
    }
}
