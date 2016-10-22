<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword ,SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'sns_code',
        'country',
        'is_active',
        'is_accept_terms',
        'is_opened'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    // 1 : 1
    public function jobs()
    {
        return $this->hasOne('App\job','job_id','job');
    }
    public function countries()
    {
        return $this->hasOne('App\country','country_id','country');
    }

    // 1: n
    public function logs()
    {
        return $this->hasMany('App\log');
    }
    public function careers()
    {
        return $this->hasMany('App\career');
    }
    public function languages()
    {
        return $this->hasMany('App\language');
    }
    public function createOfTheMonths()
    {
        return $this->hasMany('App\createOfTheMonth');
    }

}
