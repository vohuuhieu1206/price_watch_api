<?php

namespace App;

use App\Follow;
use App\Transformers\UserTransformer;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
   use Notifiable, SoftDeletes;
   //, HasApiTokens;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';


    public $transformer = UserTransformer::class;

 
    protected $date = ['delete_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'verified',
        'verification_token',
        'admin',
        'auth_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function setNameAttribute($name)
    // {
    //     $this->attributes['name'] = strtolower($name) ;

    // }
    // public function getNameAttribute($name)
    // {
    //     return ucwords($name) ; 
    // }
    // public function setEmailAttribute($email)
    // {
    //     $this->attributes['email'] = strtolower($email) ;

    // }


    public function isVerified(){
        return $this->verified == User::VERIFIED_USER;
    }
    public static function generateVerificationCode()
    {
        return str_random(40);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function follows()
    {
        return $this->hasMany(Follow::class);
    }

}
