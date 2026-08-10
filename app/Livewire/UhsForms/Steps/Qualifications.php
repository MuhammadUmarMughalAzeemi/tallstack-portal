<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\Boards;
use App\Models\ExamPassed;
use App\Models\InstitutionType;
use App\Models\MbbsPassed;
use App\Models\Qualification;
use App\Models\SscExamPassed;
use Livewire\Component;

class Qualifications extends Component
{
    public $sscPassed;
    public $sscScienceSubjects;
    public $sscInstitutionType;
    public $sscBoard;
    public $sscPassingYear;
    public $sscMarksObtained;
    public $sscTotalMarks;

    public $hsscPassed;
    public $hsscScienceSubjects;
    public $hsscInstitutionType;
    public $hsscBoard;
    public $hsscPassingYear;
    public $hsscMarksObtained;
    public $hsscTotalMarks;

    public $mbbsPassed;
    public $mbbsScienceSubjects;
    public $mbbsInstitutionType;
    public $mbbsBoard;
    public $mbbsPassingYear;
    public $mbbsMarksObtained;
    public $mbbsTotalMarks;

    public $mphilPassed;
    public $mphilScienceSubjects;
    public $mphilInstitutionType;
    public $mphilBoard;
    public $mphilPassingYear;
    public $mphilMarksObtained;
    public $mphilTotalMarks;

    public bool $isExperience = false;
    public array $experiences = [];

    protected function rules(): array
    {
        return [
            'sscPassed'           => 'required',
            'sscScienceSubjects'  => 'required',
            'sscInstitutionType'  => 'required',
            'sscBoard'            => 'required',
            'sscPassingYear'      => 'required',
            'sscMarksObtained'    => 'required|numeric',
            'sscTotalMarks'       => 'required|numeric',

            'hsscPassed'          => 'required',
            'hsscScienceSubjects' => 'required',
            'hsscInstitutionType' => 'required',
            'hsscBoard'           => 'required',
            'hsscPassingYear'     => 'required',
            'hsscMarksObtained'   => 'required|numeric',
            'hsscTotalMarks'      => 'required|numeric',

            'mbbsPassed'          => 'required',
            'mbbsScienceSubjects' => 'required',
            'mbbsInstitutionType' => 'required',
            'mbbsBoard'           => 'required',
            'mbbsPassingYear'     => 'required',
            'mbbsMarksObtained'   => 'required|numeric',
            'mbbsTotalMarks'      => 'required|numeric',
        ];
    }

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if ($user && $user->qualifications) {
            $q = $user->qualifications;
            $this->sscPassed = $q->ssc_exam_passeds_id;
            $this->sscScienceSubjects = $q->ssc_science_subjects;
            $this->sscInstitutionType = $q->ssc_institution_id;
            $this->sscBoard = $q->ssc_board_id;
            $this->sscPassingYear = $q->ssc_passing_year;
            $this->sscMarksObtained = $q->ssc_marks_obtained;
            $this->sscTotalMarks = $q->ssc_total_marks;

            $this->hsscPassed = $q->hssc_exam_passeds_id;
            $this->hsscScienceSubjects = $q->hssc_science_subjects;
            $this->hsscInstitutionType = $q->hssc_institution_id;
            $this->hsscBoard = $q->hssc_board_id;
            $this->hsscPassingYear = $q->hssc_passing_year;
            $this->hsscMarksObtained = $q->hssc_marks_obtained;
            $this->hsscTotalMarks = $q->hssc_total_marks;

            $this->mbbsPassed = $q->mbbs_exam_passeds_id;
            $this->mbbsScienceSubjects = $q->mbbs_science_subjects;
            $this->mbbsInstitutionType = $q->mbbs_institution_id;
            $this->mbbsBoard = $q->mbbs_board_id;
            $this->mbbsPassingYear = $q->mbbs_passing_year;
            $this->mbbsMarksObtained = $q->mbbs_marks_obtained;
            $this->mbbsTotalMarks = $q->mbbs_total_marks;

            $this->mphilPassed = $q->mphil_exam_passeds_id;
            $this->mphilScienceSubjects = $q->mphil_science_subjects;
            $this->mphilInstitutionType = $q->mphil_institution_id;
            $this->mphilBoard = $q->mphil_board_id;
            $this->mphilPassingYear = $q->mphil_passing_year;
            $this->mphilMarksObtained = $q->mphil_marks_obtained;
            $this->mphilTotalMarks = $q->mphil_total_marks;

            $this->isExperience = (bool) $q->is_experience;
            $this->experiences = $q->experiences ? (array) json_decode($q->experiences, true) : [];
        }
    }

    public function addExperience(): void
    {
        $this->experiences[] = [
            'fromDate' => '',
            'toDate' => '',
            'institute' => '',
            'designation' => '',
        ];
    }

    public function removeExperience(int $index): void
    {
        unset($this->experiences[$index]);
        $this->experiences = array_values($this->experiences);
    }

    public function submit(): void
    {
        $this->validate();
        /** @var \App\Models\User $user */
        $user = auth()->user();

        Qualification::updateOrCreate(
            ['user_id' => $user->id],
            [
                'ssc_exam_passeds_id'   => $this->sscPassed,
                'ssc_science_subjects'  => $this->sscScienceSubjects,
                'ssc_institution_id'    => $this->sscInstitutionType,
                'ssc_board_id'          => $this->sscBoard,
                'ssc_passing_year'      => $this->sscPassingYear,
                'ssc_marks_obtained'    => $this->sscMarksObtained,
                'ssc_total_marks'       => $this->sscTotalMarks,

                'hssc_exam_passeds_id'  => $this->hsscPassed,
                'hssc_science_subjects' => $this->hsscScienceSubjects,
                'hssc_institution_id'   => $this->hsscInstitutionType,
                'hssc_board_id'         => $this->hsscBoard,
                'hssc_passing_year'     => $this->hsscPassingYear,
                'hssc_marks_obtained'   => $this->hsscMarksObtained,
                'hssc_total_marks'      => $this->hsscTotalMarks,

                'mbbs_exam_passeds_id'  => $this->mbbsPassed,
                'mbbs_science_subjects' => $this->mbbsScienceSubjects,
                'mbbs_institution_id'   => $this->mbbsInstitutionType,
                'mbbs_board_id'         => $this->mbbsBoard,
                'mbbs_passing_year'     => $this->mbbsPassingYear,
                'mbbs_marks_obtained'   => $this->mbbsMarksObtained,
                'mbbs_total_marks'      => $this->mbbsTotalMarks,

                'mphil_exam_passeds_id'  => $this->mphilPassed,
                'mphil_science_subjects' => $this->mphilScienceSubjects,
                'mphil_institution_id'   => $this->mphilInstitutionType,
                'mphil_board_id'         => $this->mphilBoard,
                'mphil_passing_year'     => $this->mphilPassingYear,
                'mphil_marks_obtained'   => $this->mphilMarksObtained,
                'mphil_total_marks'      => $this->mphilTotalMarks,
                'is_experience'          => $this->isExperience,
                'experiences'            => $this->isExperience ? json_encode($this->experiences) : null,
            ]
        );

        $this->dispatch('completeStep', 'step3Completed');
        $this->dispatch('goToStep', 4);
    }

    public function render()
    {
        return view('livewire.uhs-forms.steps.qualifications', [
            'sscExams' => SscExamPassed::all(),
            'hsscExams' => ExamPassed::all(),
            'mbbsExams' => MbbsPassed::all(),
            'boards' => Boards::all(),
            'institutionTypes' => InstitutionType::all(),
        ]);
    }
}
