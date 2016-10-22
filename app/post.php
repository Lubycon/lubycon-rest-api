<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $dates = ['deleted_at'];

    // 1 : 1
    public function boards()
    {
        return $this->hasOne('App\board','board_id','id');
    }

    public function users()
    {
        return $this->hasOne('App\User','user_id','id');
    }
}
