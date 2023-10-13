<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email40_result extends Model
{
    use HasFactory;

    protected $fillable = [
        'typing_practise_result_id',
        'student_id',
        'institute_id',
        'subject_id',
        'EmailSend',
        'EmailTo',
        'EmailCc',
        'EmailBcc',
        'EmailSubject',
        'EmailBody',
        'EmailAtt1',
        'EmailAtt2',
    ];

    public function typing_practise_result()
    {
        return $this->belongsTo(Typing_practise_result::class);
    }
}
