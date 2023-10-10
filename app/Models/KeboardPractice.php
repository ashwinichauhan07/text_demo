<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeboardPractice extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_id',
        'subject_id',
        'name',
        'practise_type',
        'desc',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


     public function practise()
    {
        return $this->belongsTo(PractiseType::class,'practise_type');
    }


}
