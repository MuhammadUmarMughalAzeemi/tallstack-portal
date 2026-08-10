<?php

namespace Database\Seeders;

use App\Models\ResidenceArea;
use Illuminate\Database\Seeder;

class ResidenceAreaSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->areas() as $key => $name) {
            ResidenceArea::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }

    public function areas(): array
    {
        return [
            "Urban",
            "Rural",
            "Tribal",
        ];
    }
}
