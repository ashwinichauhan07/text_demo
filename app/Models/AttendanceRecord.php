<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [

    	        'student_id',


    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function itiming()
    {
        return $this->belongsTo(Itiming::class,'batch_id');
    }

       public function studentattendancerecords()
    {
        return $this->hasMany(StudentAttendanceRecord::class);
    }

}
