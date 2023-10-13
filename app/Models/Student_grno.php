<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_grno extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'student_id',
        'student_grno',
        'doaddmission',
        'isession_id',
        'year',
        'student_type'
    ];

     public function student()
    {
        return $this->belongsTo(Student::class);
    } 
}
