<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = array('utc','region','continent','name');

    public function user()
    {
        return $this->belongsTo('App\User','id','id');
    }
}
