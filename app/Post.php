<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    // 1 : 1
    public function board()
    {
        return $this->hasOne('App\Board','board_id','id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function view()
    {
        return $this->hasMany('App\View','post_id','id');
    }
}
