<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Instructorpayment;


class Instructor extends Model
{
    protected $fillable = [
    	'user_id',
        'institute_id',
        'inst_id',
        'father_name',
        'mother_name',
        'phone_no',
    	'gender',
        'address',
        'stream',
        'university',
        'passingyear',
        'percent',
        'grade',
        'identity_img',
        'status',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class,'inst_id');
    }

    public function instructorpayment()
    {
    	return $this->hasOne(Instructorpayment::class);
    }


}
