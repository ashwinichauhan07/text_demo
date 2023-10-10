<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'practisemcq_id',
        'ans',
        'ansmarathi',
        'anshindi'
    ];
    /**
     * @var mixed
     */
    private $practisemcq_id;

    public function practisemcq()
    {
        return $this->belongsTo(Practisemcq::class);
    }
}
