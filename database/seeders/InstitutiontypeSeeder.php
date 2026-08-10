<?php

namespace Database\Seeders;

use App\Models\InstitutionType;
use Illuminate\Database\Seeder;

class InstitutiontypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Public', 'Private'];
        foreach ($types as $key => $name) {
            InstitutionType::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }
}
