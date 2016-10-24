<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class board extends Model
{
    public function post()
    {
        return $this->belongsTo('App\post','board_id','board');
    }
}
