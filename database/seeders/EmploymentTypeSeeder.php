<?php

namespace Database\Seeders;

use App\Models\EmploymentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the employment types you want to seed
        $employmentTypes = [
            'Permanent',
            'Contractual',
        ];

        // Loop through the employment types and create records in the database
        foreach ($employmentTypes as $type) {
            EmploymentType::create([
                'name' => $type,
            ]);
        }
    }
}
