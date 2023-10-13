<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyboardPractiseResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'institute_id',
        'subject_id',
        'keboard_practice_id',
        'practise_type',
        'correctWords',
        'acc',
        'incorrectWords',
        'timeminute',
        'speed',
    ];

     public function keboardpractice()
    {
        return $this->belongsTo(KeboardPractice::class,'keboard_practice_id');
    }

}
