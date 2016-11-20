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
        'country_id',
        'status',
        'newsletter',
        'is_opened'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    // get reference data
    public function job()
    {
        return $this->hasOne('App\Job','id','job_id');
    }
    public function country()
    {
        return $this->hasOne('App\Country','id','country_id');
    }
    // get reference data

    // users children table
    public function log()
    {
        return $this->hasMany('App\Log','id','id');
    }
    public function career()
    {
        return $this->hasMany('App\Career','id','id');
    }
    public function language()
    {
        return $this->hasMany('App\Language','id','id');
    }
    public function createOfTheMonth()
    {
        return $this->hasMany('App\CreateOfTheMonth','id','id');
    }
    // users children table


    //post
    public function post()
    {
        return $this->belongsTo('App\Post','user_id','id');
    }
    //post


    // action
    public function giveView()
    {
        return $this->hasMany('App\View','give_user_id','id');
    }
    public function takeView()
    {
        return $this->hasMany('App\View','take_user_id','id');
    }

    public function takeComment()
    {
        return $this->hasMany('App\Comment','take_user_id','id');
    }
    public function giveComment()
    {
        return $this->hasMany('App\Comment','give_user_id','id');
    }
    // action
}
