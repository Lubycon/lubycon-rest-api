<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    // 1 : 1
    public function board()
    {
        return $this->hasOne('App\Board','id','board_id');
    }
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    public function license()
    {
        return $this->hasOne('App\License','code','license_id');
    }

    // 1 : n
    public function categoryKernel() //just create content's option of category
    {
        return $this->hasMany('App\ContentCategoryKernel','post_id','id');
    }
    public function category() //just get category reference table
    {
        return $this->hasManyThrough('App\ContentCategory','App\ContentCategoryKernel','post_id','id');
    }
    public function download()
    {
        return $this->hasMany('App\Download','post_id','id');
    }
    public function view()
    {
        return $this->hasMany('App\View','post_id','id');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment','post_id','id');
    }
    public function tag(){
        return $this->hasMany('App\ContentTag','post_id','id');
    }
    // public function bookmark()
    // {
    //     return $this->hasMany('App\Bookmark','post_id','id');
    // }
}
