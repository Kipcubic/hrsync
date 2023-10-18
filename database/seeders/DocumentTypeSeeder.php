<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = [
            [
                'name' => 'National Identity Card (ID)',
                'description' => 'An official identification document for citizens and residents.',
            ],
            [
                'name' => 'Kenyan Passport',
                'description' => 'A travel document for international journeys.',
            ],
            [
                'name' => 'Birth Certificate',
                'description' => 'Proof of date and place of birth.',
            ],
            [
                'name' => 'KRA PIN Certificate',
                'description' => 'Necessary for tax-related transactions.',
            ],
            [
                'name' => "Driver's License",
                'description' => 'Required for legal driving of a motor vehicle.',
            ],
            [
                'name' => 'Certificate of Good Conduct (Police Clearance Certificate)',
                'description' => 'Often requested for background checks.',
            ],
            [
                'name' => 'Marriage Certificate',
                'description' => 'Legal recognition of a marriage.',
            ],
            [
                'name' => 'Academic Certificates and Transcripts',
                'description' => 'Essential for education and career purposes.',
            ],


        ];

        foreach ($documentTypes as $type) {
            DocumentType::create([
                'name' => $type['name'],
                'description' => $type['description'],
            ]);
        }
    }
}
