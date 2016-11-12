<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Content;
use App\Comment;
use App\Board;
use App\User;
use App\ContentTag;

use App\Traits\InsertArrayToColumn;
use App\Traits\GetUserModelTrait;

use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\CheckContoller;
use App\Http\Controllers\Pager\PageController;

class ContentController extends Controller
{
    use InsertArrayToColumn,
        GetUserModelTrait;

    public function store(Request $request,$category){
        $data = $request->json()->all();

        $findUser = $this->getUserByToken($request);
        $contents = new Content;

        // for upload data... take code SSARU!
        // $attachedFiles = $data['attachedFiles'];
        // $attachedImg = $data['attachedImg'];
        // $userContent = $data['content'];
        // $contentType = $data['content']['type'] == '0' ? '2d' : '3d';
        // $content2dData = $data['content']['data'];
        // $map = $data['content']['data']['map'];
        // $model = $data['content']['data']['map'];
        // $lights = $data['content']['data']['map'];

        $contents->board_id = Board::where('name','=',$category)->value('id');
        $contents->user_id = $findUser->id;
        $cc = $data['setting']['cc'];
        $contents->license_id = $cc['by'].$cc['nc'].$cc['nd'].$cc['sa'];
        $contents->title = $data['setting']['title'];
        $contents->content = $data['setting']['content'];
        $contents->description = $data['setting']['description'];
        $contents->directory = ''; //needs s3! go SSARUSSARU
        $contents->is_download = isset($attachedFiles) ? true : false ;

        $contents->save(); //first, contents save

        $tagRender = $this->InsertContentTagName($data['setting']['tags']);
        $contents->tag()->saveMany($tagRender); //second, tags save relationship

        $category = $this->convertContentCategoryData($data['setting']['category']);
        $categoryRender = $this->InsertContentCategoryId($category);
        $contents->categoryKernel()->saveMany($categoryRender); //thrid, categorys save relationship

        if($contents->save()){ //check right access
          return response()->success();
        };
        return response()->error([
            "code" => "0030"
        ]);
    }
    public function getList(Request $request,$category){
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
                "contentData" => (object)array(
                     "id" => $array->id,
                     "title" => $array->title,
                     "category" => Board::find($array->board_id)->name,
                     "image" => $array->directory, //need edit
                     "license" => $array->license,
                     "bookmark" => false,
                     "like" => $array->like_count,
                     "view" => $array->view_count,
                     "comment" => $array->comment_count,
                     "download" => $array->download_count,
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
                "devMsg" => "Nothing search Contents"
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
                 "tags" => $content->tag
             ),
             "userData" => (object)array(
                 "id" => $content->user_id,
                 "name" => $content->user->name,
                 "profile" => $content->user->profile_img,
                 "job" => is_null($content->user->job) ? null : $content->user->name,
                 "country" => is_null($content->user->country) ? null : $content->user->country->name,
                 "city" => $content->user->city
             )
         ]);
    }
    public function update(Request $request,$category,$board_id){
        $data = $request->json()->all();

        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $contents = Content::findOrFail($board_id);

        if($this->isSameBoard($contents,$category)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "sector id is unmatched"
            ]);
        }
        if($this->isSameUser($findUser,$contents)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "user id is unmatched"
            ]);
        }


        // $contents->content = $data['content'];
        // $contents->save(); //first, contents save


        $tagRender = $this->InsertContentTagName($data['setting']['tags']);
        $contents->tag()->delete();
        $contents->tag()->saveMany($tagRender); //second, tags save relationship

        $category = $this->convertContentCategoryData($data['setting']['category']);
        $categoryRender = $this->InsertContentCategoryId($category);
        $contents->categoryKernel()->delete();
        $contents->categoryKernel()->saveMany($categoryRender); //thrid, categorys save relationship

        if($contents->save()){
          return response()->success();
        };

        return response()->error([
            "code" => "0030"
        ]);
    }
    public function delete(Request $request,$category,$board_id){
        $tokenData = CheckContoller::checkToken($request);
        $findUser = User::findOrFail($tokenData->id);
        $contents = Content::findOrFail($board_id);

        if($this->isSameBoard($contents,$category)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "sector id is unmatched"
            ]);
        }
        if($this->isSameUser($findUser,$contents)){
            return response()->error([
                "code" => "0012",
                "devMsg" => "user id is unmatched"
            ]);
        }
        $contents->categoryKernel()->delete();
        $contents->tag()->delete();
        if($contents->delete()){
          return response()->success();
        }
    }

    private function isSameUser($findUser,$contents){
        return $findUser->id != $contents->user_id;
    }
    private function isSameBoard($contents,$category){
        return $contents->board_id != Board::where('name','=',$category)->value('id');
    }
}
