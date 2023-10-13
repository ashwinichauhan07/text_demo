<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upperkey extends Model
{
    use HasFactory;

     protected $fillable = [
        'institute_id',
        'language_id',
        'name',
        'desc',
    ];

public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
