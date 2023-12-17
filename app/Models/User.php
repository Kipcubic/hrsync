<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Panel;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser,HasName
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'staff_number',
        'ext_no',
        'employment_date',
        'dob',
        'site_id',
        'gender',
        'basic_salary',
        'acc_no',
        'acc_name',
        'payment_currency',
        'department_id',
        'p_email',
        'job_title',
        'kra_pin',
        'nssf_no',
        'nhif_no',
        'national_id',
        'mobile_number',
        'employment_type_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }


    // department
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function employmenttype(){
        return $this->belongsTo(EmploymentType::class,'employment_type_id');
    }

    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function contract(){
        return $this->hasMany(Contract::class);
    }

    public function leaveAccruals(){
        return $this->hasMany(LeaveAccrual::class);
    }
}
