<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email30test_result extends Model
{
    use HasFactory;

    protected $fillable = [
        'typing_test_result_id',
        'student_id',
        'institute_id',
        'subject_id',
        'mailId',
        'mailSub',
        'mailBody',
        'mailSave',
        'mailAtt',
    ];

    public function typing_test_result()
    {
        return $this->belongsTo(Typing_test_result::class);
    }
}
