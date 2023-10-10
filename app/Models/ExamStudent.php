<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;

class ExamStudent extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'student_batch_allocation_id'
    ];

    public function exam()
    {
    	return $this->belongsTo(StudentBatchAllocation::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
