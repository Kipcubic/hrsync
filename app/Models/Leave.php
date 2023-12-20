<?php

namespace App\Models;

use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Leave extends Model
{
    use HasFactory;

    use StatusTrait;

    protected $fillable = ['user_id','leave_type_id','start_date','end_date','comment'];


    public function leavetype(){
        return $this->belongsTo(LeaveType::class,'leave_type_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    // departments
    public function departments(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Department::class);
    }


    // create a method to calculate duration based on leave type params
}
