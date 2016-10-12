<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','job_id','job_id');
    }
}
