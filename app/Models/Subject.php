<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name', 
    ];

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
    public function coursefee()
    {
        return $this->hasMany(Coursefee::class);
    }
     public function student()
    {
        return $this->hasMany(Student::class);
    }

    


}
