<?php

namespace Database\Seeders;

use App\Models\ExamPassed;
use Illuminate\Database\Seeder;

class ExamPassedSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->exams() as $key => $name) {
            ExamPassed::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }

    public function exams(): array
    {
        return [
            "Intermediate / Diploma Nursing",
            "Equivalent Foreign Qualification",
        ];
    }
}
