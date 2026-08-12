<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\AdmissionTest as AdmissionTestModel;
use App\Models\MdcatCenter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class AdmissionTest extends Component
{
    use Interactions;

    public int $selectedExam = 1;
    public $mdCatCenter;
    public $mdCatObtainedMarks;
    public $satBiologyMarks;
    public $satChemistryMarks;
    public $satPhyMathMarks;
    public $satUsername;
    public $satPassword;
    public $satTestDate;
    public $ucatTestDate;
    public $ucatBand;
    public $ucatObtainedMarks;
    public $ucatCandidateId;
    public $mcatObtainedMarks;
    public $mcatTestDate;
    public $mcatUsername;
    public $mcatPassword;
    public $cnic;
    public $mdCatCnic;

    protected function rules(): array
    {
        $rules = [
            'selectedExam' => 'required|numeric',
        ];

        if ($this->selectedExam == 1) {
            $rules += [
                'mdCatCnic'          => 'required',
                'mdCatCenter'        => 'required',
                'mdCatObtainedMarks' => 'required|numeric|min:0',
            ];
        } elseif ($this->selectedExam == 2) {
            $rules += [
                'satBiologyMarks'   => 'required|numeric|max:800',
                'satChemistryMarks' => 'required|numeric|max:800',
                'satPhyMathMarks'   => 'required|numeric|max:800',
                'satTestDate'       => 'required',
                'satUsername'       => 'required',
                'satPassword'       => 'required',
            ];
        } elseif ($this->selectedExam == 3) {
            $rules += [
                'ucatBand'          => 'required',
                'ucatObtainedMarks' => 'required|numeric|max:3600',
                'ucatCandidateId'   => 'required',
                'ucatTestDate'      => 'required',
            ];
        } elseif ($this->selectedExam == 4) {
            $rules += [
                'mcatObtainedMarks' => 'required|numeric|max:528',
                'mcatTestDate'      => 'required',
                'mcatUsername'      => 'required',
                'mcatPassword'      => 'required',
            ];
        }

        return $rules;
    }

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user) {
            $this->cnic = $user->personalDetails?->cnic_passport;
            $test = $user->admissionTest;

            if ($test) {
                $this->mdCatCnic = $test->md_cat_cnic;
                $this->mdCatCenter = $test->md_catCenter_id;
                $this->mdCatObtainedMarks = $test->md_cat_obtained_marks;
                $this->satBiologyMarks = $test->sat_biology_obtained_marks;
                $this->satChemistryMarks = $test->sat_chemistry_obtained_marks;
                $this->satPhyMathMarks = $test->sat_phy_math_obtained_marks;
                $this->satTestDate = $test->sat_test_date;
                $this->satUsername = $test->sat_username;
                $this->satPassword = $test->sat_password;
                $this->ucatBand = $test->ucat_band;
                $this->ucatObtainedMarks = $test->ucat_obtained_marks;
                $this->ucatCandidateId = $test->ucat_candidate_id;
                $this->ucatTestDate = $test->ucat_test_date;
                $this->mcatTestDate = $test->mcat_test_date;
                $this->mcatObtainedMarks = $test->mcat_obtained_marks;
                $this->mcatUsername = $test->mcat_username;
                $this->mcatPassword = $test->mcat_password;
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

        AdmissionTestModel::updateOrCreate(
            ['user_id' => $user->id],
            [
                'md_cat_cnic' => $this->mdCatCnic,
                'md_catCenter_id' => $this->mdCatCenter,
                'md_cat_obtained_marks' => $this->mdCatObtainedMarks,
                'sat_biology_obtained_marks' => $this->satBiologyMarks,
                'sat_chemistry_obtained_marks' => $this->satChemistryMarks,
                'sat_phy_math_obtained_marks' => $this->satPhyMathMarks,
                'sat_test_date' => $this->satTestDate,
                'sat_username' => $this->satUsername,
                'sat_password' => $this->satPassword,
                'ucat_band' => $this->ucatBand,
                'ucat_obtained_marks' => $this->ucatObtainedMarks,
                'ucat_candidate_id' => $this->ucatCandidateId,
                'ucat_test_date' => $this->ucatTestDate,
                'mcat_obtained_marks' => $this->mcatObtainedMarks,
                'mcat_test_date' => $this->mcatTestDate,
                'mcat_username' => $this->mcatUsername,
                'mcat_password' => $this->mcatPassword,
            ]
        );

        $this->dispatch('completeStep', 'step4Completed');
        $this->dispatch('goToStep', 5);
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.admission-test', [
            'mdcatCenters' => MdcatCenter::all(),
        ]);
    }
}
