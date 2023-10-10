<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Answer;
use App\Models\Subject;
use App\Models\Mcqtype;


class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'institute_id',
        'que',
        'hindique',
        'marathique',
        // 'subject_id',
        // 'mcq_type_id',
        'is_mcq',
        'wright_ans',
        'explanation',
        'hindiwright_ans',
        'hindi_explanation',
        'marathiwright_ans',
        'marathi_explanation',
        'view',

    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institute () {
        return $this->belongsTo(User::class,'institute_id','id');
    }

    public function answer()
    {
    	return $this->hasMany(Answer::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function mcqtypes()
    {
        return $this->belongsTo(Mcqtype::class,'mcq_type_id');
    }

    public function ans_right()
    {
        return $this->hasOne(Answer::class,'id','wright_ans');
    }


     public function ansmarathi()
    {
        return $this->hasOne(Answer::class,'id','marathiwright_ans');
    }
    public function anshindi()
    {
        return $this->hasOne(Answer::class,'id','hindiwright_ans');
    }


}
