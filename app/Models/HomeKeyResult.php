<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeKeyResult extends Model
{
    use HasFactory;

    protected $fillable = [
    	'student_id',
        'institute_id',
        'language_id',
        'homekey_id',
        'speed',
        'wordsCount',
        'correctWords',
        'time',
        'acc',
    ];

  

    public function homekey()
    {
        return $this->belongsTo(Homekey::class);
    }
}
