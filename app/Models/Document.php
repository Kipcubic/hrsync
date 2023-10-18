<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $fillable=['name','link','user_id','document_type_id'];
    use HasFactory;



    public function documenttype(){
        return $this->belongsTo(DocumentType::class);
    }
}
