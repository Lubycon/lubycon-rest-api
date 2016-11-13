<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentCategoryKernel extends Model
{
    protected $fillable = ['post_id','category_id'];
}
