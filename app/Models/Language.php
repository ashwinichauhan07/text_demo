<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
         'name',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function homekey()
    {
        return $this->hasOne(Homekey::class);
    }
}
