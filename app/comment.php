<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function giveUsers()
    {
        return $this->hasOne('App\User','id','give_user_id');
    }

    public function takeUsers()
    {
        return $this->hasOne('App\User','id','take_user_id');
    }

    public function boards()
    {
        return $this->hasOne('App\board','board_id','board');
    }

    public function posts()
    {
        return $this->hasOne('App\post','id','post_id');
    }
}
