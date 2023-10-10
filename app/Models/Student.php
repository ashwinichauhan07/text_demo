<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Document;
use App\Models\Isession;
use App\Models\Itiming;
use App\Models\Coursefee;
use App\Models\Studentinstallments;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Input;



class Student extends Model
{
    use HasFactory;
    use SoftDeletes;


     protected $fillable = [
    	'user_id',
        'institute_id',
        'created_id',
        'father_name',
        'mother_name',
        'student_mob',
    	'gender',
        'handicap_id',
        'address',
        'school',
        'education',
        'document_id',
        'otherdocument',
        'identity_number',
        'dob',
        'doaddmission',
        'course_id',
        'subject_id',
        'student_type',
        'itiming_id',
        'coursefee_id',
        'isession_id',
        'year',
        'student_img',
        'identity_img',
        'status',
        'lastname',
         'currentmonth'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function handicap()
    {
    	return $this->belongsTo(Handicap::class);
    }
    public function document()
    {
    	return $this->belongsTo(Document::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function isession()
    {
        return $this->belongsTo(Isession::class);
    }
    public function itiming()
    {
        return $this->belongsTo(Itiming::class);
    }
     public function coursefee()
    {
        return $this->belongsTo(Coursefee::class);
    }

    public function installments()
    {
        return $this->hasMany(Studentinstallments::class);
    }
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
    public function revenue()
    {
        return $this->belongsTo(Revenue::class);
    }
    public function student_course()
    {
        return $this->hasMany(Student_course::class);
    }
    public function student_subject()
    {
        return $this->hasMany(StudentSubject::class);
    }
    public function hallticket()
    {
        return $this->hasOne(Hallticket::class);
    }
    public function student_grno()
    {
        return $this->hasOne(Student_grno::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
   

     public function student_batch()
    {
        return $this->hasMany(Student_batch::class);
    }
    public function student_repeat()
    {
        return $this->hasMany(Student_Repeat::class);
    }
    public function student_studentType()
    {
        return $this->hasMany(Student_studentType::class);
    }

     public function studentType()
    {
      return $this->belongsTo(StudentType::class,'student_type');
    }

    public function student_reappear()
    {
        return $this->hasMany(StudentReappear::class);
    }

    public function student_license()
    {
        return $this->hasMany(LicensePayment::class);
    }

}
