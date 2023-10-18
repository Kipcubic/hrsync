<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Human Resources',
            'Finance',
            'Information Technology',
            'Sales',
            'Marketing',
            'Customer Service',
            'Research and Development',
            'Operations',
            'Supply Chain',
            'Quality Assurance',
            'Legal',
            'Management',
            'Product Development',
            'Design',
            'Public Relations',
            'Facilities Management',
            'Logistics',
            'Health and Safety',
            'Training and Development',
            'Internal Audit',
        ];

        foreach ($departments as $department) {
            Department::create([
                'name' => $department,
                'description' => 'Description for ' . $department,
            ]);
        }
    }
}
