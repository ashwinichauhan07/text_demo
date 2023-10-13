<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractiseStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'practise_exam_id'
    ];

    public function practiseexam()
    {
        return $this->belongsTo(PractiseExam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
