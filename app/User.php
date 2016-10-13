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
        'country_code',
        'is_active',
        'is_accept_terms',
        'is_opened'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    // 1 : 1
    public function job()
    {
        return $this->hasOne('App\job');
    }
    public function country()
    {
        return $this->hasOne('App\country');
    }

    // 1: n
    public function log()
    {
        return $this->hasMany('App\log');
    }
    public function career()
    {
        return $this->hasMany('App\career');
    }
    public function language()
    {
        return $this->hasMany('App\language');
    }
    public function createOfTheMonth()
    {
        return $this->hasMany('App\createOfTheMonth');
    }

}
