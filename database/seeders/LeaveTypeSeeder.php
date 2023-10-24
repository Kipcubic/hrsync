<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveType::create([
            'name' => 'Annual Leave',
            'gender' => 'Both',
            'days_accrued' => 'Yearly',
            'max_days_year' => 21, // As per Kenyan labor law
            'max_days_carried' => 6, // As per Kenyan labor law
            'accrual_registered_at' => 'Start of the Year',
            'max_negative_balance' => 0,
            'attachment' => false,
            'off_days' => true,
            'holidays' => false,
        ]);

        LeaveType::create([
            'name' => 'Sick Leave',
            'gender' => 'Both',
            'days_accrued' => 'Monthly',
            'max_days_year' => 30, // As per Kenyan labor law
            'max_days_carried' => 15, // As per Kenyan labor law
            'accrual_registered_at' => 'Start of Contract',
            'max_negative_balance' => 0,
            'attachment' => false,
            'off_days' => true,
            'holidays' => false,
        ]);

        LeaveType::create([
            'name' => 'Maternity Leave',
            'gender' => 'Female',
            'days_accrued' => 'Yearly',
            'max_days_year' => 90, // As per Kenyan labor law
            'max_days_carried' => 0, // Maternity leave cannot be carried forward as per Kenyan labor law
            'accrual_registered_at' => 'Start of the Year',
            'max_negative_balance' => 0,
            'attachment' => true,
            'off_days' => true,
            'holidays' => false,
        ]);

        LeaveType::create([
            'name' => 'Paternity Leave',
            'gender' => 'Male',
            'days_accrued' => 'Yearly',
            'max_days_year' => 14, // As per Kenyan labor law
            'max_days_carried' => 0, // Paternity leave cannot be carried forward as per Kenyan labor law
            'accrual_registered_at' => 'Start of the Year',
            'max_negative_balance' => 0,
            'attachment' => true,
            'off_days' => true,
            'holidays' => false,
        ]);

        LeaveType::create([
            'name' => 'Study Leave',
            'gender' => 'Both',
            'days_accrued' => 'Yearly',
            'max_days_year' => 14, // Customize as per the organization's policy
            'max_days_carried' => 0, // Customize as per the organization's policy
            'accrual_registered_at' => 'Start of the Year',
            'max_negative_balance' => 0,
            'attachment' => false,
            'off_days' => true,
            'holidays' => false,
        ]);

        LeaveType::create([
            'name' => 'Compassionate Leave',
            'gender' => 'Both',
            'days_accrued' => 'N/A', // Compassionate leave is usually granted as needed
            'max_days_year' => 5, // Customize as per the organization's policy
            'max_days_carried' => 0, // Compassionate leave is not carried forward
            'accrual_registered_at' => 'N/A', // Not applicable for compassionate leave
            'max_negative_balance' => 0,
            'attachment' => false,
            'off_days' => true,
            'holidays' => false,
        ]);

        LeaveType::create([
            'name' => 'Pre-Adoptive Leave',
            'gender' => 'Both',
            'days_accrued' => 'N/A', // Pre-adoptive leave is usually granted as needed
            'max_days_year' => 60, // Customize as per the organization's policy
            'max_days_carried' => 0, // Pre-adoptive leave is not carried forward
            'accrual_registered_at' => 'N/A', // Not applicable for pre-adoptive leave
            'max_negative_balance' => 0,
            'attachment' => true,
            'off_days' => true,
            'holidays' => false,
        ]);

    }
}
