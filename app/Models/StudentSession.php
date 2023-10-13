<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'batch_id',
        'date',
        'in_time',
        'out_time',
    ];

    public function itiming()
    {
        return $this->belongsTo(Itiming::class,'batch_id');
    }

}
