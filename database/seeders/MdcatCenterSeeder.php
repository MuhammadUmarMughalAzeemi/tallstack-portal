<?php

namespace Database\Seeders;

use App\Models\MdcatCenter;
use Illuminate\Database\Seeder;

class MdcatCenterSeeder extends Seeder
{
    public function run(): void
    {
        $centers = ['UHS Lahore', 'NUST Islamabad', 'KMU Peshawar', 'DUHS Karachi'];
        foreach ($centers as $key => $name) {
            MdcatCenter::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }
}
