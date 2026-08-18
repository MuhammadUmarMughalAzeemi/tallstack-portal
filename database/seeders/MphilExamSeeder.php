<?php

namespace Database\Seeders;

use App\Models\MphilExam;
use Illuminate\Database\Seeder;

class MphilExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = [
            ['name' => 'MPhil', 'slug' => 'mphil', 'status' => 1],
            ['name' => 'MS', 'slug' => 'ms', 'status' => 1],
            ['name' => 'FCPS', 'slug' => 'fcps', 'status' => 1],
            ['name' => 'Equivalent', 'slug' => 'equivalent', 'status' => 1],
        ];

        foreach ($exams as $exam) {
            MphilExam::updateOrCreate(
                ['slug' => $exam['slug']],
                $exam
            );
        }
    }
}
