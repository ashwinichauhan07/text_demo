<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement30test_result extends Model
{
    use HasFactory;

    protected $fillable = [
        'typing_practise_result_id',
        'student_id',
        'institute_id',
        'subject_id',
        'head',
        'columnhead',
        'celalign',
        'colwidth',
        'border',
        'former',
        'total'
    ];

    public function typing_test_result()
    {
        return $this->belongsTo(Typing_test_result::class);
    }

}
