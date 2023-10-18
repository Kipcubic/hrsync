<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     // Common banks
     $banks = [
        [
            'name' => 'Kenya Commercial Bank (KCB)',
            'code' => '01',
            'website' => 'https://www.kcbgroup.com/',
            'description' => 'One of the largest and oldest banks in Kenya.',
        ],
        [
            'name' => 'Equity Bank',
            'code' => '03',
            'website' => 'https://www.equitybankgroup.com/',
            'description' => 'A leading commercial bank in Kenya.',
        ],
        [
            'name' => 'Cooperative Bank of Kenya',
            'code' => '11',
            'website' => 'https://www.co-opbank.co.ke/',
            'description' => 'A customer-focused bank with a cooperative structure.',
        ],
        [
            'name' => 'Standard Chartered Bank',
            'code' => '02',
            'website' => 'https://www.sc.com/ke/',
            'description' => 'A multinational bank with a presence in Kenya.',
        ],
        [
            'name' => 'Barclays Bank of Kenya',
            'code' => '07',
            'website' => 'https://www.barclays.co.ke/',
            'description' => 'A subsidiary of Absa Group Limited.',
        ],
        [
            'name' => 'Diamond Trust Bank (DTB)',
            'code' => '63',
            'website' => 'https://dtbk.dtbafrica.com/ke/',
            'description' => 'A regional bank with a presence in Kenya.',
        ],
        [
            'name' => 'Stanbic Bank',
            'code' => '31',
            'website' => 'https://www.stanbicbank.co.ke/',
            'description' => 'A subsidiary of Standard Bank Group.',
        ],
        [
            'name' => 'National Bank of Kenya',
            'code' => '04',
            'website' => 'https://nationalbank.co.ke/',
            'description' => 'A Kenyan government-owned bank.',
        ],
        [
            'name' => 'Family Bank',
            'code' => '05',
            'website' => 'https://familybank.co.ke/',
            'description' => 'A mid-sized bank in Kenya.',
        ],
        [
            'name' => 'NIC Bank (Now part of NCBA)',
            'code' => '41',
            'website' => 'https://www.ncbagroup.com/',
            'description' => 'Merged with Commercial Bank of Africa (CBA) to form NCBA Group.',
        ],
    ];

    // Loop through the banks and create records in the database
    foreach ($banks as $bank) {
        Bank::create([
            'name' => $bank['name'],
            'code' => $bank['code'],
            'website' => $bank['website'],
            'description' => $bank['description'],
        ]);
    }
    }
}
