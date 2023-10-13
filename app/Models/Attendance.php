<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [

        'student_id',
        'batch_id',
        'd',
        'attendance'


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
 