<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter_result extends Model
{
    use HasFactory;
    protected $fillable = [
        'typing_practise_result_id',
        'student_id',
        'institute_id',
        'subject_id',
        'head',
        'reference',
        'add',
        'sub',
        'salute',
        'paragraph',
        'close',
        'enclosure'
        ];

    public function typing_practise_result()
    {
        return $this->belongsTo(Typing_practise_result::class);
    }



}
