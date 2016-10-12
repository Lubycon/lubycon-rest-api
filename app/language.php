<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','language_group_id','language_group_id');
    }
}
