<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypingWordPractices extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'institute_id',
        'wordpractice',
        
        
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institute () {
        return $this->belongsTo(User::class,'institute_id','id');
    }

}
