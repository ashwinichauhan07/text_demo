<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractiseType extends Model
{
      use HasFactory;

     protected $fillable = [
        'institute_id',
        'practise_type',
         'subject_id',
         'name', 

    ];

     public function keboardPractice()
    {
      return $this->hanMany(KeboardPractice::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


}
