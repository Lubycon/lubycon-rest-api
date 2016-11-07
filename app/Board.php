<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = array('*');
    
    public function post()
    {
        return $this->belongsTo('App\Post','board_id','board');
    }
}
