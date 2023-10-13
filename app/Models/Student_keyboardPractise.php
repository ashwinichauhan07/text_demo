<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_keyboardPractise extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'student_id',
        'subject_id',
        'practise_type',
        'keboard_practice_id',
    ];
}
