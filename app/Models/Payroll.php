<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{

    protected $fillable=['name','month','year','description'];
    use HasFactory;

}
