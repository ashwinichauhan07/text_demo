<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typing_practise_result extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'institute_id',
        'subject_id',
        'typing_practise_id',
        'practise_type',
        'time',
        'tmark',
        'obtmark',
        'countmistake',
        'countlength',
    ];



    public function letter_result()
    {
        return $this->hasOne(Letter_result::class);
    }

    public function statement30_result()
    {
        return $this->hasOne(statement30_result::class);
    }

    public function email30_result()
    {
        return $this->hasOne(Email30_result::class);
    }
    public function email40_result()
    {
        return $this->hasOne(Email40_result::class);
    }

    public function statement40_result()
    {
        return $this->hasOne(statement40_result::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function typingpractise()
    {
        return $this->belongsTo(TypingPractise::class,'typing_practise_id');
    }

    public function practisetype()
    {
        return $this->belongsTo(PractiseType::class,'practise_type');
    }

     public function keboardpractice()
    {
        return $this->belongsTo(TypingPractise::class,'typing_practise_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
