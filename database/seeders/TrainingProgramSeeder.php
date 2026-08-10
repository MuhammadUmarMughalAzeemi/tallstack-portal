<?php

namespace Database\Seeders;

use App\Models\TrainingProgram;
use Illuminate\Database\Seeder;

class TrainingProgramSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->programs() as $programData) {
            foreach ($programData['programs'] as $programName) {
                TrainingProgram::firstOrCreate([
                    'name' => $programData['name'],
                    'program_name' => $programName,
                ]);
            }
        }
    }

    public function programs(): array
    {
        return [
            [
                'name' => 'FPGMI',
                'programs' => [
                    'Anatomy',
                    'Chemical Pathology',
                    'Haematology',
                    'Microbiology',
                    'Biochemistry',
                    'Community Medicine',
                    'Histopathology',
                    'Pharmacology',
                    'Physiology',
                ]
            ],
            [
                'name' => 'PGMI',
                'programs' => [
                    'Anatomy',
                    'Forensic Medicine',
                    'Histopathology',
                    'Pharmacology',
                    'Biochemistry',
                    'Haematology',
                    'Microbiology',
                    'Physiology',
                ]
            ],
            [
                'name' => 'IPH',
                'programs' => [
                    'Community Medicine',
                    'Master in Public Health (MPH)',
                ]
            ],
        ];
    }
}
