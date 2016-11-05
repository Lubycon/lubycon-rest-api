<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    public function giveUser()
    {
        return $this->hasOne('App\User','id','give_user_id');
    }

    public function takeUser()
    {
        return $this->hasOne('App\User','id','take_user_id');
    }

    public function board()
    {
        return $this->hasOne('App\Board','board_id','board');
    }

    public function post()
    {
        return $this->hasOne('App\Post','id','post_id');
    }
}
