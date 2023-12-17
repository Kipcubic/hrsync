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
       // Define the employment types along with their accrual_days
       $employmentTypes = [
        'Permanent' => 2,  // Adjust the accrual_days as needed
        'Contractual' => 1.75,  // Adjust the accrual_days as needed
    ];

    // Loop through the employment types and create records in the database
    foreach ($employmentTypes as $type => $accrualDays) {
        EmploymentType::create([
            'name' => $type,
            'accrual_days' => $accrualDays,
        ]);
    }
    }
}
