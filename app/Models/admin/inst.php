<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inst extends Model
{
    use HasFactory;

    public function isession()
    {
        return $this->belongsTo(Isession::class);
    }

}

