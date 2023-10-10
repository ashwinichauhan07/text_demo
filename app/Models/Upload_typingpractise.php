<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload_typingpractise extends Model
{
    use HasFactory;

     protected $fillable = [
         'typing_practise_id',
          'typingdata', 
        ];

    public function upload()
    {
        return $this->belongsTo(TypingPractise::class,'typingpractise_id');
    }


}
