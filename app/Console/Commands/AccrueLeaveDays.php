<?php

namespace App\Console\Commands;

use App\Models\LeaveAccrual;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Console\Command;

class AccrueLeaveDays extends Command
{
    protected $signature = 'leave:accrue';
    protected $description = 'Accrue leave days for all users based on leave type settings';

    public function handle()
    {
        // Retrieve all users with their contracts and contract types
        $users = User::with('employmenttype')->get();

        foreach ($users as $user) {
            // Check if the user has a contract and the contract has a contract type
            if ($user->employmenttype && $user->employmenttype) {
                $employmentType = $user->employmenttype;

                $leaveType = LeaveType::where('name', 'Annual Leave')->first();

                if($leaveType->employmenttype()->contain([$employmentType->id])){

                }
                // Find the leave type you want to accrue (e.g., Annual Leave)


                $accrualDate = now()->endOfMonth();

                // Check if the user has already accrued leave for the current month
                $lastAccrual = $user->leaveAccruals()->whereDate('accrual_date', $accrualDate)->first();

                if (!$lastAccrual) {
                    // Create a new accrual record
                    $accrualDays = $contractType->accrual_days ?? 0; // Default to 0 if not set
                    $accrual = new LeaveAccrual([
                        'user_id' => $user->id,
                        'accrual_date' => $accrualDate,
                        'leave_days' => $accrualDays,
                    ]);

                    $accrual->save();
                } else {
                    $this->info("Already accrued days for user {$user->id}.");
                }
            } else {
                $this->info("No Contract or Contract Type for user {$user->id}.");
            }
        }

        $this->info('Leave days accrued for all users with contracts.');
    }
}
