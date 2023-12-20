<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDay extends Model
{
    use HasFactory;

    protected $fillable=['days','leave_type','year','user_id'];

    // user
    public function user(){
        return $this->belongsTo(User::class);
    }


    public function histories()
    {
        return $this->hasMany(LeaveDayHistory::class);
    }


     // Method to increment leave days based on the days accrued
     public static function incrementLeaveDays($user, $daysAccrued)
     {
         $leaveDay = self::where('user_id', $user->id)->where('year', now()->year)->first();

         if (!$leaveDay) {
             // Create a new leave day record if it doesn't exist
             $leaveDay = new LeaveDay([
                 'user_id' => $user->id,
                 'year' => now()->year,
                 'days' => $daysAccrued,
                 'leave_type' => '1', // Annual Leave
             ]);

             $leaveDay->save();
         } else {
             // Update the existing leave day record
             $leaveDay->increment('days', $daysAccrued);
         }
     }

}
