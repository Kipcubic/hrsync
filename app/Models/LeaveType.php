<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveType extends Model
{

    protected $fillable=['name','gender','accrues','weekends','days_accrued','max_days_year','max_days_carried','accrual_registered_at','employment_type_id','max_negative_balance','attachment','off_days','holidays'];
    use HasFactory;


    public function employmenttype(){
        return $this->belongsToMany(EmploymentType::class);
    }

}
