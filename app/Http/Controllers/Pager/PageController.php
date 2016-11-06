<?php

namespace App\Http\Controllers\Pager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\User;
use App\Comment;
use App\View;
use App\Board;

class PageController extends Controller
{
    public $model;
    public $query;
    private $categoryName;
    private $firstFageNumber = 0;
    private $maxSize = 50;
    private $defaultSize = 20;
    private $searchAllUser = false;
    private $searchAllPost = false;
    private $sortDefault = 0; // 0 = recent, default result
    private $sort;

    private $setPage;
    private $pageSize;
    private $searchUser;
    public $searchUserName = 'id';
    private $searchPostName = 'id';
    private $sortOption;

    public $userModelFunctionName = 'user';
    public $withUserModel;
    private $paginator;
    private $collection;

    public function __construct($section,$category,$query){
        $this->query = $query;
        $this->sort = (object)array('option' => 'created_at','direction' => 'desc');

        $this->categoryName = $this->getSectionName($section);
        $this->setModel($section);
        $this->setPageRange();
        $this->setModelFilter();
        $this->bindData();
    }

    private function initComment(){
        $this->query['sort'] = 1;
        $this->searchPostName = 'post_id';

        if(isset($this->query['userType'])){
            if($this->query['userType'] == 'give'){
                $this->userModelFunctionName = 'giveUser';
                $this->searchUserName = 'give_user_id';
                return;
            }else{
                $this->userModelFunctionName = 'takeUser';
                $this->searchUserName = 'take_user_id';
                return;
            }
        }else{
            $this->userModelFunctionName = 'takeUser';
            $this->searchUserName = 'take_user_id';
            return;
        }
    }

    private function getSectionName($section){
        if($section == 'comment'){
            $this->initComment();
            return 'comment';
        }else{
            return Board::select('group')->where('name','=',$section)->firstOrFail()->value('group');
        }
    }

    private function setModel($section){
        switch($this->categoryName){
            case 'post' : $this->model = new Post; break;
            case 'comment' : $this->model = new Comment; break;
            // case 'content' : $this->model = new Content;
            default : break; //error point
        }
    }

    private function setPageRange(){
        $this->setPage = isset($this->query['pageIndex']) ? $this->query['pageIndex'] : $this->firstFageNumber;
        $this->pageSize = isset($this->query['pageSize']) && $this->query['pageSize'] <= $this->maxSize ? $this->query['pageSize'] : $this->defaultSize;
        $this->searchPost = isset($this->query['boardId']) ? $this->query['boardId'] : $this->searchAllPost;
        $this->searchUser = isset($this->query['userId']) ? $this->query['userId'] : $this->searchAllUser;
        $this->sortOption = isset($this->query['sort']) ? $this->query['sort'] : $this->sortDefault;
        switch($this->sortOption){
            case 1 : break; //recent
            case 2 : $this->sort->option = 'view_count' ; break; //view count
            case 3 : $this->sort->option = 'comment_count' ; break; //comment count
            case 4 : $this->sort->option = 'download_count' ; break; //download count
            default : break; //error point
        }
    }

    private function setModelFilter(){
        if($this->searchUser){
            $this->model = $this->model->where($this->searchUserName,'=',$this->searchUser);
        }
        if($this->searchPost){
            $this->model = $this->model->where($this->searchPostName,'=',$this->searchPost);
        }
    }

    private function bindData(){
        $this->withUserModel = $this->model->with($this->userModelFunctionName);
        $this->paginator = $this->withUserModel->
            orderBy($this->sort->option,$this->sort->direction)->
            paginate($this->pageSize, ['*'], 'page', $this->setPage);
        $this->collection = $this->paginator->getCollection();
    }

    public function getCollection(){
        return $this->collection;
    }
}
