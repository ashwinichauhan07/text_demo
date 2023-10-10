<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hallticket extends Model
{
    use HasFactory;

     protected $fillable = [
     	'institute_id',
        'student_id',
     	'subject_id',
        'exambatch_id',
        'exam_date',
        'start_time',
        'end_time',
        'day',
        'batch',
        'center_name'

    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    } 

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

}
