<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractiseExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'user_id',
        'question_bank_no',
        'name',
        'result'
    ];

    public function student()
    {
        return $this->hasMany(PractiseStudent::class);
    }

    public function institute()
    {
        return $this->belongsTo(User::class,'institute_id','id');
    }


    public function question_bank()
    {
        return $this->hasOne(McqBank::class,'id','question_bank_no');
    }

    public function paper()
    {
        return $this->hasMany(Paper::class);
    }
}
