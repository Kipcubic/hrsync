<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            [
                'name' => 'New Year',
                'date' => '2023-01-01',
                'description' => 'Celebration of the start of the new year.',
            ],
            [
                'name' => 'Easter Monday',
                'date' => '2023-04-10',
                'description' => 'The day after Easter Sunday, a Christian holiday commemorating the resurrection of Jesus.',
            ],
            [
                'name' => 'Mashujaa Day',
                'date' => '2023-10-20',
                'description' => 'A day to celebrate national heroes (shujaa in Swahili) who contributed to Kenya\'s independence and development.',
            ],
            [
                'name' => 'Jamhuri Day',
                'date' => '2023-12-12',
                'description' => 'Celebrating Kenya\'s independence and the establishment of the republic.',
            ],
            [
                'name' => 'Christmas Day',
                'date' => '2023-12-25',
                'description' => 'A Christian holiday celebrating the birth of Jesus Christ.',
            ],
            [
                'name' => 'Boxing Day',
                'date' => '2023-12-26',
                'description' => 'A day for giving to the less fortunate and relaxing after Christmas.',
            ],
            [
                'name' => 'Labour Day',
                'date' => '2023-05-01',
                'description' => 'A day to celebrate and honor the achievements of workers and labor movements.',
            ],
            [
                'name' => 'Good Friday',
                'date' => '2023-04-07',
                'description' => 'A Christian holiday commemorating the crucifixion of Jesus.',
            ],

            [
                'name' => 'Madaraka Day',
                'date' => '2023-06-01',
                'description' => 'Celebrating the day Kenya attained self-rule from British colonial rule in 1963.',
            ],

        ];

        foreach ($holidays as $holiday) {
            Holiday::create([
                'name' => $holiday['name'],
                'date' => $holiday['date'],
                'description' => $holiday['description'],
            ]);
        }
    }
}
