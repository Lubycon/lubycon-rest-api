<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function giveUser()
    {
        return $this->hasOne('App\User','id','give_user_id');
    }
    public function user() //give users
    {
        return $this->hasOne('App\User','id','give_user_id');
    }

    public function takeUser()
    {
        return $this->hasOne('App\User','id','take_user_id');
    }

    public function board()
    {
        return $this->hasOne('App\Board','id','board_id');
    }

    public function post()
    {
        return $this->hasOne('App\Post','id','post_id');
    }
}
