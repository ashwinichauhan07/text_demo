<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use Illuminate\Database\Eloquent\SoftDeletes;


class Studentinstallments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
    	'student_id',
        'institute_id',
        'created_id',
    	'amount',
    	'mode',
    	'check_number',
    	'type',
    	'check_date',
        'next_installmentdate',
        'installment_date',
        'transaction_id',
        'totalpaid_amount',
        'balance_amount',
        'currentmonth'
    ];

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

     public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
