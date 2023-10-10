<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emailtest30_result;

class Typing_test_result extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'institute_id',
        'subject_id',
        'typingtest_id',
        'practise_type',
        'time',
        'tmark',
        'obtmark',
        'countmistake',
        'countlength',
    ];

    public function letter30_result()
    {
        return $this->hasOne(Letter30test_result::class);
    }

    public function statementtest30_result()
    {
        return $this->hasOne(Statement30test_result::class);
    }

    public function emailtest30_result()
    {
        return $this->hasOne(Email30test_result::class);
    }
    public function email40_result()
    {
        return $this->hasOne(Email40test_result::class);
    }

    public function statementtest40_result()
    {
        return $this->hasOne(Statement40test_result::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function typingtest()
    {
        return $this->belongsTo(Typingtest::class,'typingtest_id');
    }

    public function practisetype()
    {
        return $this->belongsTo(PractiseType::class,'practise_type');
    }
}
