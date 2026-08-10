<?php

namespace Database\Seeders;

use App\Models\CnicPassport;
use Illuminate\Database\Seeder;

class CnicPassportSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['CNIC', 'Passport', 'NICOP', 'POC'];
        foreach ($types as $key => $name) {
            CnicPassport::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }
}
