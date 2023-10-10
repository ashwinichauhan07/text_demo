<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student_batch extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [

        'student_id',
    	 'batch_id',
         'student_type',

    ];

     public function student()
    {
        return $this->belongsTo(Student::class);
    }
      public function itiming()
    {
        return $this->belongsTo(Itiming::class,'batch_id');
    }
}
