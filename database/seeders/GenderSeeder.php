<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->genders() as $key => $name) {
            Gender::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }

    public function genders(): array
    {
        return [
            'Male',
            'Female',
            'Other',
        ];
    }
}
