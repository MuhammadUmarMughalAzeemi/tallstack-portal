<?php

namespace Database\Seeders;

use App\Models\SscExamPassed;
use Illuminate\Database\Seeder;

class SscExamPassedSeeder extends Seeder
{
    public function run(): void
    {
        $exams = ['Matriculation / SSC', 'O-Levels', 'Equivalent Foreign Qualification'];
        foreach ($exams as $key => $name) {
            SscExamPassed::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }
}
