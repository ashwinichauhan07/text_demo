<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStudent extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'm_c_q_practise_exam_id'
    ];

    public function exam()
    {
    	return $this->belongsTo(MCQPractiseExam::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
