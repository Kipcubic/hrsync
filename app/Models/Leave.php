<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','leave_type_id','start_date','end_date','comment'];


    public function leavetype(){
        return $this->belongsTo(LeaveType::class,'leave_type_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
