<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Student;


class Institute extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'principle_name',
        'principle_mob',
        'principle_email',
        'address',
        'course_id',
        'start_time',
        'end_time',
        'pc',
        'institute_code',
        'inst_logo',
        'status',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function installments()
    {
        return $this->hasMany(Studentinstallments::class);
    }
    public function mcqpractiseexam()
    {

        return $this->hasMany(MCQPractiseExam::class);
    }
    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }
    public function revenue()
    {
        return $this->belongsTo(Revenue::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

     public function institutecourse()
    {
        return $this->hasMany(InstituteCourse::class);
    }
    public function exambatches()
    {
        return $this->hasMany(ExamBatches::class);
    }
    public function hallticket()
    {
        return $this->hasMany(Hallticket::class);
    }
    public function language()
    {
        return $this->hasMany(Language::class);
    }

    public function homekey()
    {
        return $this->hasMany(Homekey::class);
    }
    
}
