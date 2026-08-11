<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\UserServices\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterUser extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    protected $userServices;

    public $cnic_passport;

    public $showInput = 0;

    public $cnic;

    public $cnicTypes;

    public $currentLabel = '';

    public function boot(UserService $userServices): void
    {
        $this->userServices = $userServices;
    }

    public function mount()
    {
        $this->cnicTypes = $this->userServices->getAllCnicPassport()
            ->values();
    }

    protected function rules(): array
    {
        $requiredRules = [
            'name' => 'required|regex:/^[A-Za-z\s\-]+$/',
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password',
            'cnic' => 'required',
        ];
        $cnicId = (int) ($this->cnic ?? $this->showInput);
        $size = in_array($cnicId, [4, 5]) ? 9 : 13;
        if (in_array($cnicId, [4, 5, 6])) {
            // Passport (alphanumeric)
            $requiredRules['cnic_passport'] = [
                'required',
                "size:$size",
                'regex:/^[a-zA-Z0-9]+$/',
                'unique:users,cnic_passport',
            ];
        } else {
            // CNIC (numbers only)
            $requiredRules['cnic_passport'] = [
                'required',
                "size:$size",
                'regex:/^[0-9]+$/',
                'unique:users,cnic_passport',
            ];
        }

        return $requiredRules;
    }

    public function getAllCnicPassportProperty()
    {
        return $this->userServices->getAllCnicPassport()->toArray();
    }

    public function updatedCnic($value)
    {
        $identityType = $this->userServices->getAllCnicPassport()
            ->firstWhere('id', (int) $value);
        if ($identityType) {
            $this->showInput = (int) $value;
            $this->currentLabel = $identityType->name;

        } else {
            $this->showInput = 0;
            $this->currentLabel = '';
        }

        $this->reset('cnic_passport');
    }

    public function submit()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'cnic_passport' => $this->cnic_passport,
            'cnic_passport_id' => $this->cnic,
        ]);

        event(new Registered($user));

        Auth::login($user);

        session()->regenerate();

        return redirect()->route('uhs-form');
    }

    public function render()
    {
        return view('livewire.register-user');
    }
}
