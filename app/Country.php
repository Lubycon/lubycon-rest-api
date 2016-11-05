<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','id','id');
    }
    protected $guarded = array('*');
}
