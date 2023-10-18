<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shifts')->insert([
            [
                'name' => 'Regular Shift',
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'flexible' => false,
                'description' => 'Regular morning shift',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Flexible Shift',
                'start_time' => null, // Start time is null
                'end_time' => null,   // End time is null
                'flexible' => true,   // The only flexible shift
                'description' => 'Flexible shift with no fixed times',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Afternoon Shift',
                'start_time' => '12:00:00',
                'end_time' => '20:00:00',
                'flexible' => false,
                'description' => 'Regular afternoon shift',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Morning Shift',
                'start_time' => '08:00:00',
                'end_time' => '12:00:00',
                'flexible' => false,
                'description' => 'Regular Morning shift',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
