<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\CnicPassport;
use App\Models\District;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\PersonalDetail;
use App\Models\ResidenceArea;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class PersonalDetails extends Component
{
    use Interactions;
    use WithFileUploads;

    public $image;
    public $name;
    public $motherName;
    public $fatherName;
    public $dob;
    public $mobileNumber;
    public $secondaryNumber;
    public $telephoneNumber;
    public $email;
    public $genderId;
    public $residenceId;
    public $address;
    public $domicile;
    public $cnic;
    public $cnic_passport;
    public $nationalityId;
    public $city;
    public $country;
    public $showInput = 0;

    protected function rules(): array
    {
        return [
            'name'            => 'required|string|max:255',
            'fatherName'      => 'required|string|max:255',
            'motherName'      => 'required|string|max:255',
            'dob'             => 'required|date',
            'mobileNumber'    => 'required|string',
            'telephoneNumber' => 'nullable|string',
            'email'           => 'required|email',
            'genderId'        => 'required',
            'residenceId'     => 'required',
            'address'         => 'required|string',
            'domicile'        => 'required',
            'city'            => 'required|string',
            'country'         => 'required|string',
            'cnic'            => 'required',
            'cnic_passport'   => 'required|string',
            'nationalityId'   => 'required',
        ];
    }

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->mobileNumber = $user->mobile_number;
            $this->fatherName = $user->father_name;
            $this->cnic = $user->cnic_passport_id;
            $this->cnic_passport = $user->cnic_passport;

            $details = $user->personalDetails;
            if ($details) {
                $this->motherName = $details->mother_name;
                $this->dob = $details->date_of_birth;
                $this->mobileNumber = $details->mobile_number;
                $this->secondaryNumber = $details->secondary_number;
                $this->telephoneNumber = $details->telephone_number;
                $this->genderId = $details->gender_id;
                $this->residenceId = $details->residence_area_id;
                $this->address = $details->address;
                $this->domicile = $details->district_id;
                $this->cnic = $details->cnic_passport_id;
                $this->cnic_passport = $details->cnic_passport;
                $this->nationalityId = $details->nationality_id;
                $this->city = $details->city;
                $this->country = $details->country;
                $this->showInput = $details->showInput;
            }
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

        PersonalDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'mother_name'       => $this->motherName,
                'date_of_birth'     => $this->dob,
                'mobile_number'     => $this->mobileNumber,
                'telephone_number'  => $this->telephoneNumber,
                'gender_id'         => $this->genderId,
                'residence_area_id' => $this->residenceId,
                'address'           => $this->address,
                'district_id'       => $this->domicile,
                'cnic_passport'     => $this->cnic_passport,
                'cnic_passport_id'  => $this->cnic,
                'nationality_id'    => $this->nationalityId,
                'secondary_number'  => $this->secondaryNumber,
                'city'              => $this->city,
                'country'           => $this->country,
                'showInput'         => $this->cnic,
            ]
        );

        $user->update([
            'name'        => $this->name,
            'father_name' => $this->fatherName,
        ]);

        $this->dispatch('completeStep', 'step2Completed');
        $this->dispatch('goToStep', 3);
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.personal-details', [
            'genders' => Gender::all(),
            'residenceAreas' => ResidenceArea::all(),
            'nationalities' => Nationality::all(),
            'districts' => District::all(),
            'cnicPassports' => CnicPassport::all(),
        ]);
    }
}
