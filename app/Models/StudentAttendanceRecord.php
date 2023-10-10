<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceRecord extends Model
{
    use HasFactory;



      protected $fillable = [
      	
      	'attendance_records_id',
        'batch_id',

    ];

    public function attendanceRecord(){

    	return $this->belongsTo(AttendanceRecord::class);
    }
   
    public function batch(){

    	return $this->hasMany(Batch::class);
    }
}
