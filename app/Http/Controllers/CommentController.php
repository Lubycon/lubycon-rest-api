<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Board;
use App\User;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\CheckContoller;
use App\Http\Controllers\Pager\PageController;

class CommentController extends Controller
{
    public function store(Request $request,$category,$board_id){
        $data = $request->json()->all();

        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $comments = new Comment;

        $comments->give_user_id = $findUser->id;
        $comments->take_user_id = $data['getUserId'];
        $comments->board_id = Board::where('name','=',$category)->value('id');
        $comments->post_id = $board_id;
        $comments->content = $data['content'];

        if($comments->save()){
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

        $result = (object)array(
            "totalCount" => $controller->totalCount,
            "currentPage" => $controller->currentPage,
            "comments" => []
        );
        foreach($collection as $array){
            $result->comments[] = (object)array(
                "commentData" => (object)array(
                     "id" => $array->id,
                     "board_id" => $array->post_id,
                     "content" => $array->content,
                     "date" => Carbon::instance($array->created_at)->toDateTimeString(),
                ),
                "userData" => (object)array(
                    "id" => $array->user->id,
                    "name" => $array->user->name,
                    "profile" => $array->user->profile_img
                )
            );
        };

        if(!is_null($result->comments)){
            return response()->success($result);
        }else{
            return response()->error([
                "code" => "0062",
                "devMsg" => "Model not found error"
            ]);
        }
    }
    public function update(Request $request,$category,$board_id,$comment_id){
        $data = $request->json()->all();

        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $comments = Comment::findOrFail($comment_id);

        if($this->isSameBoard($comments,$category)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "sector id is unmatched"
            ]);
        }
        if($this->isSamePost($comments,$board_id)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "post id is unmatched"
            ]);
        }
        if($this->isSameUser($findUser,$comments)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "user id is unmatched"
            ]);
        }

        $comments->content = $data['content'];
        if($comments->save()){
          return response()->success();
        };

        return response()->error([
            "code" => "0030"
        ]);
    }
    public function delete(Request $request,$category,$board_id,$comment_id){
        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $comments = Comment::findOrFail($comment_id);

        if($this->isSameBoard($comments,$category)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "sector id is unmatched"
            ]);
        }
        if($this->isSamePost($comments,$board_id)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "post id is unmatched"
            ]);
        }
        if($this->isSameUser($findUser,$comments)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "user id is unmatched"
            ]);
        }
        if($comments->delete()){
          return response()->success();
        }
    }

    private function isSameUser($findUser,$comments){
        return $findUser->id != $comments->give_user_id;
    }
    private function isSamePost($comments,$board_id){
        return $comments->post_id != $board_id;
    }
    private function isSameBoard($comments,$category){
        return $comments->board_id != Board::where('name','=',$category)->value('id');
    }
}
