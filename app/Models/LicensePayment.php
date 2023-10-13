<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LicensePayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'total_payment_id',
        'institute_id',
        'student_id',
        'subject_id',
        'amount',
        'amount_status',
        'added_by'
    ];

    public function total_payment()
    {
        return $this->belongsTo(Total_payment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
