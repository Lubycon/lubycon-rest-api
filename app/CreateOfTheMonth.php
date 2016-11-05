<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateOfTheMonth extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
