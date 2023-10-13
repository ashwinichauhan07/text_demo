<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReappear extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'student_id',
        'doaddmission',
        'student_type',
        'isession_id',
        'year'
        ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function student_subject()
    {
        return $this->hasMany(StudentSubject::class);
    }

}
