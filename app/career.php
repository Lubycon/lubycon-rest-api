<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class career extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','id','career_group_id');
    }
}
