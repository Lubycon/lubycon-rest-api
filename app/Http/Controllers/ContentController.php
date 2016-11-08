<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Content;
use App\Comment;
use App\Board;
use App\User;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\CheckContoller;
use App\Http\Controllers\Pager\PageController;

class ContentController extends Controller
{
    public function store(Request $request,$category){
        $data = $request->json()->all();

        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $contents = new Content;

        $contents->board_id = Board::where('name','=',$category)->value('id');
        $contents->user_id = $findUser->id;
        $contents->license_id = $data['setting']['cc'];
        $contents->title = $data['setting']['title'];
        $contents->content = $data['setting']['content'];
        $contents->description = $data['setting']['description'];
        $contents->directory = ''; //needs s3
        $contents->is_download = false; //follow attatch files exists

        if($contents->save()){
          return response()->success();
        };
        return response()->error([
            "code" => "0030"
        ]);
    }
    public function getList(Request $request,$board_id=false){
        $query = $request->query();
        $board_id = $board_id ? $query['boardId'] = $board_id : null ;
        $controller = new PageController('comment',$query);
        $collection = $controller->getCollection();

        foreach($collection as $array){
            $result[] = (object)array(
                "contents" => (object)array(
                     "id" => $array->id,
                     "board_id" => $array->post_id,
                     "view" => $array->content,
                     "date" => Carbon::instance($array->created_at)->toDateTimeString(),
                ),
                "userData" => (object)array(
                    "id" => $array->user->id,
                    "name" => $array->user->name,
                    "profile" => $array->user->profile_img
                )
            );
        };

        if(isset($result)){
            return response()->success($result);
        }else{
            return response()->error([
                "code" => "0062",
                "devMsg" => "Model not found error"
            ]);
        }
    }
    public function viewPost($category,$board_id){
         $content = Content::findOrFail($board_id);

         return response()->success([
             "contents" => (object)array(
                 "id" => $content->id,
                 "title" => $content->title,
                 "subCategory" => $content->category,
                 "content" => $content->content,
                 "description" => $content->description,
                 "date" => Carbon::instance($content->created_at)->toDateTimeString(),
                 "bookmark" => false,
                 "like" => false,
                 "likeCount" => $content->like_count,
                 "viewCount" => $content->view_count,
                 "downloadCount" => $content->view_count,
                 "filePath" => $content->filePath,
                 "CC" => $content->license,
                //  "tags" =>
             ),
             "userData" => (object)array(
                 "id" => $content->user_id,
                 "name" => $content->user->name,
                 "profile" => $content->user->profile_img,
                 "job" => is_null($content->user->job) ? null : $job->name,
                 "country" => is_null($content->user->country) ? null : $content->user->country->name,
                 "city" => $content->user->city
             )
         ]);
    }
    public function update(Request $request,$category,$board_id,$comment_id){
        $data = $request->json()->all();

        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $contents = Content::findOrFail($comment_id);

        if($this->isSameBoard($contents,$category)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "sector id is unmatched"
            ]);
        }
        if($this->isSamePost($contents,$board_id)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "post id is unmatched"
            ]);
        }
        if($this->isSameUser($findUser,$contents)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "user id is unmatched"
            ]);
        }
        $this->resetDataGroup($contents);

        $contents->content = $data['content'];
        if($contents->save()){
          return response()->success();
        };

        return response()->error([
            "code" => "0030"
        ]);
    }
    public function delete(Request $request,$category,$board_id,$content_id){
        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $contents = Content::findOrFail($comment_id);

        if($this->isSameBoard($contents,$category)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "sector id is unmatched"
            ]);
        }
        if($this->isSamePost($contents,$board_id)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "post id is unmatched"
            ]);
        }
        if($this->isSameUser($findUser,$contents)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "user id is unmatched"
            ]);
        }
        if($contents->delete()){
          return response()->success();
        }
    }

    private function isSameUser($findUser,$contents){
        return $findUser->id != $contents->give_user_id;
    }
    private function isSamePost($contents,$board_id){
        return $contents->post_id != $board_id;
    }
    private function isSameBoard($contents,$category){
        return $contents->board_id != Board::where('name','=',$category)->value('id');
    }
    protected function resetDataGroup($content){
        $content->tag->delete();
    }
}
