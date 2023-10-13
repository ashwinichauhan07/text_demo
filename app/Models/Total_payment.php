<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Total_payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
         'payment'
    ];

    public function licensepayment()
    {
        return $this->hasOne(LicensePayment::class);
    }

}
