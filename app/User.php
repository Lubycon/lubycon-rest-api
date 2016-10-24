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

    // get reference data
    public function jobs()
    {
        return $this->hasOne('App\job','job_id','job');
    }
    public function countries()
    {
        return $this->hasOne('App\country','country_id','country');
    }
    // get reference data

    // users children table
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
    // users children table


    //post
    public function posts()
    {
        return $this->belongsTo('App\post');
    }
    //post


    // action
    public function giveViews()
    {
        return $this->hasMany('App\view','give_user_id','id');
    }
    public function takeViews()
    {
        return $this->hasMany('App\view','take_user_id','id');
    }

    public function takeComments()
    {
        return $this->hasMany('App\comment','take_user_id','id');
    }
    public function giveComments()
    {
        return $this->hasMany('App\comment','give_user_id','id');
    }
    // action
}
