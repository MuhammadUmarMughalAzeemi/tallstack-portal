<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\SeatCategory;
use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->colleges() as $collegeData) {
            $program = SeatCategory::where('name', $collegeData['program'])->first();

            if ($program) {
                College::firstOrCreate([
                    'seat_category_id' => $program->id,
                    'name' => $collegeData['name'],
                ]);
            }
        }
    }

    public function colleges(): array
    {
        return [
            // Ph.D. Programs
            ['name' => 'Anatomy', 'program' => 'Ph.D.'],
            ['name' => 'Biochemistry', 'program' => 'Ph.D.'],
            ['name' => 'Forensic Medicine', 'program' => 'Ph.D.'],
            ['name' => 'Haematology', 'program' => 'Ph.D.'],
            ['name' => 'Histopathology', 'program' => 'Ph.D.'],
            ['name' => 'Human Genetics & Molecular Biology', 'program' => 'Ph.D.'],
            ['name' => 'Immunology', 'program' => 'Ph.D.'],
            ['name' => 'Microbiology', 'program' => 'Ph.D.'],
            ['name' => 'Medical Education', 'program' => 'Ph.D.'],
            ['name' => 'Pharmacology', 'program' => 'Ph.D.'],
            ['name' => 'Physiology', 'program' => 'Ph.D.'],

            // M.Phil. Programs
            ['name' => 'Anatomy', 'program' => 'M.PHIL'],
            ['name' => 'Behavioural Sciences', 'program' => 'M.PHIL'],
            ['name' => 'Biochemistry', 'program' => 'M.PHIL'],
            ['name' => 'Chemical Pathology', 'program' => 'M.PHIL'],
            ['name' => 'Community Medicine', 'program' => 'M.PHIL'],
            ['name' => 'Forensic Medicine', 'program' => 'M.PHIL'],
            ['name' => 'Haematology', 'program' => 'M.PHIL'],
            ['name' => 'Histopathology', 'program' => 'M.PHIL'],
            ['name' => 'Human Genetics & Molecular Biology', 'program' => 'M.PHIL'],
            ['name' => 'Immunology', 'program' => 'M.PHIL'],
            ['name' => 'Medical Laboratory Sciences', 'program' => 'M.PHIL'],
            ['name' => 'Microbiology', 'program' => 'M.PHIL'],
            ['name' => 'Oral Biology', 'program' => 'M.PHIL'],
            ['name' => 'Oral Pathology', 'program' => 'M.PHIL'],
            ['name' => 'Pharmacology', 'program' => 'M.PHIL'],
            ['name' => 'Physiology', 'program' => 'M.PHIL'],

            // Master Programs
            ['name' => 'Master in Health Professions Education (MHPE)', 'program' => 'Master'],
            ['name' => 'Master of Nursing (MSN)', 'program' => 'Master'],
            ['name' => 'Master in Public Health (MPH)', 'program' => 'Master'],
        ];
    }
}
