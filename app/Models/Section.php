<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'institute_id'
    ];

	public function typingtest()
    {
    	return $this->hanMany(Typingtest::class);
    }
}
