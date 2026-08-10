<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@uhs.edu.pk'],
            [
                'name' => 'UHS Admin',
                'password' => Hash::make('password'),
                'father_name' => 'System Admin',
                'mobile_number' => '03000000000',
                'cnic_passport' => '00000-0000000-0',
                'status' => 1,
            ]
        );

        // Applicant / Student User
        User::updateOrCreate(
            ['email' => 'student@uhs.edu.pk'],
            [
                'name' => 'Muhammad Ali',
                'password' => Hash::make('password'),
                'father_name' => 'Tariq Mahmood',
                'mobile_number' => '03001234567',
                'cnic_passport' => '35201-1234567-1',
                'pmdc_pnmc' => '12345-P',
                'status' => 2,
            ]
        );
    }
}
