<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PractiseMCQTest extends Model
{
    use HasFactory;


    use SoftDeletes;

    protected $fillable = [
    	'user_id',
        'institute_id',
        'questionPaperName',
        'subject_id',
        'level',
        'total_writing_question',
        'total_mcq_question',
        'each_writing_mark',
        'each_mcq_mark',
        'each_negative_writing_mark',
        'each_negative_mcq_mark',
        'required_time',
        'question',

    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institute() {
        return $this->belongsTo(User::class,'institute_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function mcqtype()
    {
        return $this->belongsTo(Mcqtype::class,'level','id');
    }


}
