<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor;
use App\Models\User;

class Instructorpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'instructor_id', 
        'institute_id',
         'amount',
         'name',
         'mode',
         'cheque_number',
         'cheque_date'
    ];

    public function instructor()
    {
    	return $this->belongsTo(Instructor::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
