<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcqtest extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id', 'mcqtype_id', 'timer', 'que_mark', 'criteria', 'test_date', 
        'institute_id'
    ];
    public function student()
    {
    	return $this->hanMany(Student::class);
    }
    // public function mcqtype()
    // {
    // 	return $this->hanMany(Mcqtype::class);
    // }
}
