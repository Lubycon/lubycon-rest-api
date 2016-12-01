<?php

namespace App\Models;

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
        return $this->hasOne('App\Models\Job','id','job_id');
    }
    public function country()
    {
        return $this->hasOne('App\Models\Country','id','country_id');
    }
    // get reference data

    // users children table
    public function log()
    {
        return $this->hasMany('App\Models\Log','user_id','id');
    }
    public function career()
    {
        return $this->hasMany('App\Models\Career','user_id','id');
    }
    public function language()
    {
        return $this->hasMany('App\Models\Language','user_id','id');
    }
    public function createOfTheMonth()
    {
        return $this->hasMany('App\Models\CreateOfTheMonth','user_id','id');
    }
    // users children table


    //post
    public function post()
    {
        return $this->belongsTo('App\Models\Post','user_id','id');
    }
    //post


    // action
    public function giveView()
    {
        return $this->hasMany('App\Models\View','give_user_id','id');
    }
    public function takeView()
    {
        return $this->hasMany('App\Models\View','take_user_id','id');
    }

    public function takeComment()
    {
        return $this->hasMany('App\Models\Comment','take_user_id','id');
    }
    public function giveComment()
    {
        return $this->hasMany('App\Models\Comment','give_user_id','id');
    }
    // action
}
