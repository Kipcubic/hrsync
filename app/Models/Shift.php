<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{

    protected $fillable=['name','flexible','start_time','end_time','active'];
    use HasFactory;

    // users
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
