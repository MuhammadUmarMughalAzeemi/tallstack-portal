<?php

namespace Database\Seeders;

use App\Models\SeatCategory;
use Illuminate\Database\Seeder;

class SeatCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->programs() as $key => $programData) {
            SeatCategory::updateOrCreate(
                ['id' => $key + 1],
                [
                    'name' => $programData['name'],
                    'challan_type_id' => $programData['challan_type_id'],
                ]
            );
        }
    }

    public function programs(): array
    {
        return [
            ['name' => 'Ph.D.', 'challan_type_id' => 391],
            ['name' => 'M.PHIL', 'challan_type_id' => 392],
            ['name' => 'Master', 'challan_type_id' => 390],
        ];
    }
}
