<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $dates = ['deleted_at'];

    // 1 : 1
    public function board()
    {
        return $this->hasOne('App\board','board_id','id');
    }

    public function users()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function views()
    {
        return $this->hasMany('App\view','post_id','id');
    }
}
