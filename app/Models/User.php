<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Institute;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'password',
        'token',
        'otp',
        'userType',
        'typing_id',
        'show_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

     public function roles()
    {
        return $this->hasOne(Role::class,'id','userType');
    }
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function institute()
    {
        return $this->hasOne(Institute::class);
    }
     public function instructor()
    {
        return $this->hasOne(Instructor::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }
    public function practisemcq()
    {
        return $this->hasMany(Practisemcq::class);
    }
     public function institutecourse()
    {
        return $this->hasMany(InstituteCourse::class);
    }

    public function typing_word_practices()
    {
        return $this->hasMany(TypingWordPractices::class);
    }

    // public function typing_practise_result()
    // {
    //     return $this->hasMany(Typing_practise_result::class);
    // }

}
