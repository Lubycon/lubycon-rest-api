<?php
namespace App\Traits;

use App\User;
use App\Content;

use App\View;
use App\Donwload;
use App\Like;
use App\Bookmark;

trait UserActionTrait{
    function viewCountUp($post){
        $post->increment('view_count');
        $post->view_count += 1;
    }
}
 ?>
