<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typingtest extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'subject_id',
        'practise_type',
        'typingdata',
        'key'
    ];


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function practise()
    {
        return $this->belongsTo(PractiseType::class,'practise_type');
    }

}


