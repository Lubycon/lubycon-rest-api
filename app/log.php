<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','log_group_id','log_group_id');
    }
}
