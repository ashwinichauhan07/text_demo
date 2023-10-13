<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Practisemcq extends Model

{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'institute_id',
        'que',
        'quemarathi',
        'quehindi',
        'subject_id',
        'mcq_type_id',
        'is_mcq',
        'wright_ans',
        'explanation',
        'marathiwright_ans',
        'explanation_marathi',
        'hindiwright_ans',
        'explanation_hindi',
        'view',
        'file_path',
        'name',
        'language',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function mcqtypes()
    {
        return $this->belongsTo(Mcqtype::class,'mcq_type_id');
    }
    public function ans()
    {
        return $this->hasMany(McqAnswer::class);
    }
    public function ans_right()
    {
        return $this->hasOne(McqAnswer::class,'id','wright_ans');
    }
    public function ansmarathi()
    {
        return $this->hasOne(McqAnswer::class,'id','marathiwright_ans');
    }
    public function anshindi()
    {
        return $this->hasOne(McqAnswer::class,'id','hindiwright_ans');
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }
    

    

    
}
