<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpperKeyResult extends Model
{
    use HasFactory;
    protected $fillable = [
    	'student_id',
        'institute_id',
        'language_id',
        'speed',
        'wordsCount',
        'correctWords',
        'time',
        'acc',
    ];
}
