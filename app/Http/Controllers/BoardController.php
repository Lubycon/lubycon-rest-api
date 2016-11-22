<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\View;
use App\Models\Board;

use Event;
use App\Events\UserActionRecodeEvent;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\CheckContoller;
use App\Http\Controllers\Pager\PageController;

class BoardController extends Controller
{

   public function listPost(Request $request,$category){
       $query = $request->query();
       $controller = new PageController($category,$query);
       $collection = $controller->getCollection();

       $result = (object)array(
           "totalCount" => $controller->totalCount,
           "currentPage" => $controller->currentPage,
           "contents" => []
       );
       foreach($collection as $array){
           $result->contents[] = (object)array(
               "postData" => (object)array(
                    "id" => $array->id,
                    "title" => $array->title,
                    "comment" => $array->comment_count,
                    "like" => $array->like_count,
                    "view" => $array->view_count,
                    "date" => Carbon::instance($array->created_at)->toDateTimeString(),
               ),
               "userData" => (object)array(
                   "id" => $array->user->id,
                   "name" => $array->user->name,
                   "profile" => $array->user->profile_img
               )
           );
       };

       if(!is_null($result->contents)){
           return response()->success($result);
       }else{
           return response()->error([
               "code" => "0062",
               "devMsg" => "Model not found error"
           ]);
       }
   }
   public function viewPost(Request $request,$category,$board_id){
        $post = Post::findOrFail($board_id);
        Event::fire(new UserActionRecodeEvent($request,'view',$post));
        $job = $post->user->job;

        return response()->success([
            "contents" => (object)array(
                "id" => $post->id,
                "title" => $post->title,
                "date" => Carbon::instance($post->created_at)->toDateTimeString(),
                "content" => $post->content,
                "likeCount" => $post->like_count,
                "viewCount" => $post->view_count,
                "like" => false,
            ),
            "userData" => (object)array(
                "id" => $post->user_id,
                "name" => $post->user->name,
                "profile" => $post->user->profile_img,
                "job" => is_null($job) ? null : $job->name,
                "country" => $post->user->country->name,
                "city" => $post->user->city
            )
        ]);
   }
   public function uploadPost(Request $request,$category){
        $data = $request->json()->all();

        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);

        $posts = new Post;

        $posts->board_id = 1;
        $posts->user_id = $findUser->id;
        $posts->title = $data['title'];
        $posts->content = $data['content'];
        if($posts->save()){
          return response()->success();
        };

        return response()->error([
            "code" => "0030"
        ]);
   }
   public function updatePost(Request $request,$category,$board_id){
        $data = $request->json()->all();

        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $posts = Post::findOrFail($board_id);

        if($findUser->id != $posts->user_id){
            return response()->error([
                "code" => "0012"
            ]);
        }

        $posts->title = $data['title'];
        $posts->content = $data['content'];
        if($posts->save()){
          return response()->success();
        };

        return response()->error([
            "code" => "0030"
        ]);
   }
   public function deletePost(Request $request,$category,$board_id){
        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $posts = Post::findOrFail($board_id);

        if($findUser->id != $posts->user_id){
            return response()->error([
                "code" => "0012"
            ]);
        }
        if($posts->delete()){
          return response()->success();
        }
   }
}
