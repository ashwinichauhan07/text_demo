<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itiming extends Model
{
    use HasFactory;
    protected $fillable = [
    	'start_time', 'end_time', 'institute_id'
    ];
     public function student()
    {
    	return $this->hasMany(Student::class);
    }

    public function attendance()
    {
    	return $this->hasMany(Attendance::class);
    }
}
