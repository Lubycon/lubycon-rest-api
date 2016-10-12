<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class career extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','career_group_id','career_group_id');
    }
}
