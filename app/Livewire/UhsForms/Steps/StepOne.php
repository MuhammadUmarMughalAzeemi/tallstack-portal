<?php

namespace App\Livewire\UhsForms\Steps;

use App\Models\User;
use App\Services\UserMediaService;
use Livewire\Component;

class StepOne extends Component
{
    // No public model properties — data is loaded fresh in render()
    // to avoid serializing large Eloquent objects into Livewire state on every request.

    public function editStep(int $stepNumber): void
    {
        $this->dispatch('goToStep', $stepNumber);
    }

    public function back(): void
    {
        $this->dispatch('goToStep', 6);
    }

    public function proceedToSubmit(): void
    {
        $this->dispatch('goToStep', 8);
    }

    public function render()
    {
        /** @var User|null $user */
        $user = auth()->user();

        if ($user) {
            $user->loadMissing([
                'personalDetails.gender',
                'personalDetails.cnicPassport',
                'personalDetails.area',
                'personalDetails.district',
                'personalDetails.nationality',
                'qualifications.sscExam',
                'qualifications.sscBoard',
                'qualifications.sscInstitution',
                'qualifications.hsscExam',
                'qualifications.hsscBoard',
                'qualifications.hsscInstitution',
                'qualifications.mbbsExam',
                'qualifications.mbbsBoard',
                'qualifications.mbbsInstitution',
                'qualifications.mphilExam',
                'qualifications.mphilBoard',
                'qualifications.mphilInstitution',
                'admissionTest',
                'seatCategories',
                'mphillPhdSubjects',
                'media',
            ]);
        }

        $mediaService = $user ? new UserMediaService($user) : null;

        $documents = [
            'photo' => [
                'key' => 'photo',
                'label' => 'Passport Size Photograph',
                'category' => 'Identity & Personal',
                'url' => $mediaService?->url(User::MEDIA_PHOTO),
                'icon' => 'user-circle',
                'required' => true,
                'is_image' => true,
            ],
            'signature' => [
                'key' => 'signature',
                'label' => 'Digital Signature',
                'category' => 'Identity & Personal',
                'url' => $mediaService?->url(User::MEDIA_SIGNATURE),
                'icon' => 'pencil-square',
                'required' => true,
                'is_image' => true,
            ],
            'cnic' => [
                'key' => 'cnic',
                'label' => 'CNIC / Passport (Front)',
                'category' => 'Government ID',
                'url' => $mediaService?->url(User::MEDIA_CNIC),
                'icon' => 'identification',
                'required' => true,
                'is_image' => true,
            ],
            'cnicBack' => [
                'key' => 'cnicBack',
                'label' => 'CNIC / Passport (Back)',
                'category' => 'Government ID',
                'url' => $mediaService?->url(User::MEDIA_CNIC_BACK),
                'icon' => 'identification',
                'required' => true,
                'is_image' => true,
            ],
            'fatherCnic' => [
                'key' => 'fatherCnic',
                'label' => "Father's CNIC (Front)",
                'category' => 'Guardian ID',
                'url' => $mediaService?->url(User::MEDIA_FATHER_CNIC),
                'icon' => 'identification',
                'required' => true,
                'is_image' => true,
            ],
            'fatherCnicBack' => [
                'key' => 'fatherCnicBack',
                'label' => "Father's CNIC (Back)",
                'category' => 'Guardian ID',
                'url' => $mediaService?->url(User::MEDIA_FATHER_CNIC_BACK),
                'icon' => 'identification',
                'required' => true,
                'is_image' => true,
            ],
            'domicile' => [
                'key' => 'domicile',
                'label' => 'Domicile Certificate',
                'category' => 'Residence & Domicile',
                'url' => $mediaService?->url(User::MEDIA_DOMICILE),
                'icon' => 'document-text',
                'required' => true,
                'is_image' => true,
            ],
            'matricTranscript' => [
                'key' => 'matricTranscript',
                'label' => 'Matric / SSC Transcript',
                'category' => 'Academic Credentials',
                'url' => $mediaService?->url(User::MEDIA_MATRIC_TRANSCRIPT),
                'icon' => 'academic-cap',
                'required' => true,
                'is_image' => true,
            ],
            'intermediateTranscript' => [
                'key' => 'intermediateTranscript',
                'label' => 'F.Sc / HSSC Transcript',
                'category' => 'Academic Credentials',
                'url' => $mediaService?->url(User::MEDIA_INTERMEDIATE_TRANSCRIPT),
                'icon' => 'academic-cap',
                'required' => true,
                'is_image' => true,
            ],
            'mdcatResult' => [
                'key' => 'mdcatResult',
                'label' => 'MDCAT / Test Result',
                'category' => 'Admission Test',
                'url' => $mediaService?->url(User::MEDIA_MDCAT_RESULT),
                'icon' => 'clipboard-document-check',
                'required' => false,
                'is_image' => true,
            ],
        ];

        $otherDocuments = $mediaService?->otherDocuments() ?? collect();

        $experiences = [];
        if ($user?->qualifications?->is_experience && ! empty($user->qualifications->experiences)) {
            $decoded = json_decode($user->qualifications->experiences, true);
            if (is_array($decoded)) {
                $experiences = $decoded;
            }
        }

        return view('livewire.uhs-forms.steps.step-one', [
            'user'              => $user,
            'personalDetails'   => $user?->personalDetails,
            'qualifications'    => $user?->qualifications,
            'admissionTest'     => $user?->admissionTest,
            'seatCategories'    => $user ? $user->seatCategories : collect(),
            'mphillPhdSubjects' => $user ? $user->mphillPhdSubjects : collect(),
            'documents'         => $documents,
            'otherDocuments'    => $otherDocuments,
            'experiences'       => $experiences,
        ]);
    }
}
