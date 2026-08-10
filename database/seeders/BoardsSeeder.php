<?php

namespace Database\Seeders;

use App\Models\Boards;
use Illuminate\Database\Seeder;

class BoardsSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->boards() as $key => $name) {
            Boards::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }

    public function boards(): array
    {
        return [
            "Cambridge International Examinations (CIE) O-Levels",
            "Cambridge International Examinations (CIE) A-Levels",
            "Board of Intermediate and Secondary Education, Bahawalpur",
            "Board of Intermediate and Secondary Education, DG Khan",
            "Board of Intermediate and Secondary Education, Faisalabad",
            "Board of Intermediate and Secondary Education, Gujranwala",
            "Board of Intermediate and Secondary Education, Lahore",
            "Board of Intermediate and Secondary Education, Multan",
            "Board of Intermediate and Secondary Education, Rawalpindi",
            "Board of Intermediate and Secondary Education, Sahiwal",
            "Board of Intermediate and Secondary Education, Sargodha",
            "Aga Khan Educational Board, Karachi",
            "Federal Board of Intermediate and Secondary Education,Islamabad",
            "Board of Intermediate Education, Karachi",
            "Board of Intermediate and Secondary Education, Hyderabad",
            "Board of Intermediate and Secondary Education, Larkana",
            "Board of Intermediate and Secondary Education, Sukkur",
            "Board of Secondary Education, Karachi",
            "Board of Intermediate and Secondary Education, Abbottabad",
            "Board of Intermediate and Secondary Education, Bannu",
            "Board of Intermediate and Secondary Education, Dera Ismail Khan",
            "Board of Intermediate and Secondary Education, Kohat",
            "Board of Intermediate and Secondary Education, Malakand",
            "Board of Intermediate and Secondary Education, Mardan",
            "Board of Intermediate and Secondary Education, Peshawar",
            "Board of Intermediate and Secondary Education, Swat",
            "Board of Intermediate and Secondary Education, Quetta",
            "Board of Intermediate and Secondary Education, Turbat",
            "Board of Intermediate and Secondary Education, Zhob",
            "Board of Intermediate and Secondary Education, Mirpur",
            "Other",
        ];
    }
}
