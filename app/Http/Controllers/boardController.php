<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\post;
use App\User;
use App\comment;
use App\view;
use App\board;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\CheckContoller;

class boardController extends Controller
{
   public function listPost(){
        return 'contents list';
   }
   public function viewPost($category,$board_id){
        $post = post::find($board_id);

        if(is_null($post)){
            return response()->error([
                "code" => "0062"
            ]);
        }
        $job = $post->users->jobs;

        return response()->success([
            "contents" => (object)array(
                "code" => $post->id,
                "title" => $post->title,
                "date" => $post->created_at,
                "content" => $post->content,
                "like_count" => $post->like_count,
                "view_count" => $post->view_count,
                "like" => false,
            ),
            "userData" => (object)array(
                "code" => $post->user_id,
                "name" => $post->users->name,
                "profile" => $post->users->profile_img,
                "job" => is_null($job) ? null : $job->name,
                "country" => $post->users->countries->name,
                "city" => $post->users->city
            )
        ]);
   }
   public function uploadPost(Request $request,$category){
        $data = $request->json()->all();

        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::find($tokenData->id);

        $posts = new post;

        $posts->board = 1;
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
        $findUser = User::find($tokenData->id);

        $posts = post::find($board_id);

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
        $findUser = User::find($tokenData->id);

        $posts = post::find($board_id);

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
