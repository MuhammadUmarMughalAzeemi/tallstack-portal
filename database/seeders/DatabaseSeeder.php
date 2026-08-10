<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProgramSeeder::class,
            SeatCategorySeeder::class,
            GenderSeeder::class,
            NationalitySeeder::class,
            ResidenceAreaSeeder::class,
            DistrictSeeder::class,
            BoardsSeeder::class,
            ExamPassedSeeder::class,
            CollegeSeeder::class,
            InstitutiontypeSeeder::class,
            MdcatCenterSeeder::class,
            CnicPassportSeeder::class,
            SscExamPassedSeeder::class,
            MbbsPassedSeeder::class,
            TrainingProgramSeeder::class,
            UserSeeder::class,
        ]);
    }
}
