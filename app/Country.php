<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = array('*');
    
    public function user()
    {
        return $this->belongsTo('App\User','id','id');
    }
}
