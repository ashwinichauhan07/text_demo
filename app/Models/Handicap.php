<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Handicap extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
    ];

    public function student()
    {
    	return $this->hanMany(Student::class);
    }

  }
