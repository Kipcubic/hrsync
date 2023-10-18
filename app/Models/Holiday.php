<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{

    protected $fillable=['name','date','repeat','user_id','description'];
    use HasFactory;
}
