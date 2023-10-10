<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Institute;

class InstituteCourse extends Model
{
    use HasFactory;

     protected $fillable = [
    	
        'institute_id',
    	 'course_id',
    	
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
