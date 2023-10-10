<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Isession extends Model
{
    use HasFactory;
    use SoftDeletes;

     protected $fillable = [
    	'start_session',
         'end_session',
         'active'
    ];

    public function student()
    {
    	return $this->hanMany(Student::class);
    }
    public function inst()
    {
    	return $this->hanMany(Inst::class);
    }
    public function month()
    {
        return $this->belongsTo(Month::class,'start_session');
    }

    public function monthname()
    {
        return $this->belongsTo(Month::class,'end_session');
    }
}
