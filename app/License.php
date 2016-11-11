<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $guarded = array('code','url','icon','description');

    public function content()
    {
        return $this->belongsTo('App\Content','license_id','id');
    }
}
