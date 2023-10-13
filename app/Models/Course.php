<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function subject()
    {
    	return $this->hanMany(Subject::class);
    }
    public function coursefee()
    {
    	return $this->hanMany(Coursefee::class);
    }
    public function student()
    {
        return $this->hanMany(Student::class);
    }
    public function institue()
    {
        return $this->hanMany(Institute::class);
    }
    public function studentinstallments()
    {
        return $this->hanMany(Studentinstallments::class);
    }
    public function institute()
    {
        return $this->hanMany(Institute::class);
    }
    public function student_course()
    {
        return $this->hanMany(Student_course::class);
    }

}
