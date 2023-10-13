<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grnumber extends Model
{
    use HasFactory;
    protected $fillable = [
    	'institute_id',
    	'grnumber'
    ];
}
