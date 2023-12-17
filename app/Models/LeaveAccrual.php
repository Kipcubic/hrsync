<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAccrual extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'accrual_date', 'leave_days'];

    // user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
