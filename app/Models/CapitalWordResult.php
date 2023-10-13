<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapitalWordResult extends Model
{
    use HasFactory;

    protected $fillable = [
    	'student_id',
        'institute_id',
        'speed',
        'wordsCount',
        'correctWords',
        'time',
        'acc',
    ];
}
