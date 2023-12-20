<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(BankSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(EmploymentTypeSeeder::class);
        $this->call(HolidaySeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(LeaveTypeSeeder::class);

        \App\Models\User::factory(2000)->create();

    }
}
