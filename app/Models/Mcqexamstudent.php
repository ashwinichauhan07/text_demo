<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;


class Mcqexamstudent extends Model
{
    use HasFactory;


    protected $fillable = [
    	'user_id',
    	'exam_id',
        'student_batch_allocation_id',
        'exam_otp'
    ];

    public function exam()
    {
    	return $this->belongsTo(Exam::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
