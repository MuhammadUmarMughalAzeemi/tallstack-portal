<?php

namespace Database\Seeders;

use App\Models\MbbsPassed;
use Illuminate\Database\Seeder;

class MbbsPassedSeeder extends Seeder
{
    public function run(): void
    {
        $exams = ['MBBS', 'BDS', 'Pharm-D', 'BS Nursing','B.Sc(Hons)','Post RN', 'MS'];
        foreach ($exams as $key => $name) {
            MbbsPassed::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }
}
