<?php

namespace App\Http\Controllers\Pager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\post;
use App\User;
use App\comment;
use App\view;
use App\board;

class PageController extends Controller
{
    private $model;
    private $query;
    private $categoryParse;
    private $firstFageNumber = 0;
    private $maxSize = 50;
    private $defaultSize = 20;
    private $searchAllUser = false;
    private $sortDefault = 0; // 0 = recent, default result
    private $sort;

    private $setPage;
    private $pageSize;
    private $searchUser;
    private $sortOption;

    private $postWithUser;
    private $paginator;
    private $collection;

    public function __construct($category,$query){
        $this->getModel($category);
        $this->query = $query;
        $this->sort = (object)array('option' => 'created_at','direction' => 'desc');

        $this->setPageRange();
        $this->setModelFilter();
        $this->bindData();
    }
    public function getModel($category){
        $this->categoryParse = board::select('group')->where('name','=',$category)->firstOrFail();
        switch($this->categoryParse->group){
            case 'post' : $this->model = new post;
            // case 'content' : $this->model = new content;
            default :
            return 'error';
            break; //error point
        }
    }

    public function setPageRange(){
        /////// target page number
        $this->setPage = isset($this->query['pageIndex']) ? $this->query['pageIndex'] : $this->firstFageNumber;
        /////// page per contents
        $this->pageSize = isset($this->query['pageSize']) && $this->query['pageSize'] <= $this->maxSize ? $this->query['pageSize'] : $this->defaultSize;
        //////// find target users post
        $this->searchUser = $this->query['userId'] ? $this->query['userId'] : $this->searchAllUser;
        //////// sort option set
        $this->sortOption = $this->query['sort'] ? $this->query['sort'] : $this->sortDefault;
        //////// set sort property
        switch($this->sortOption){
            case 1 : $this->sort->option = 'created_at' ; $this->sort->direction = 'desc'; break; //recent
            case 2 : $this->sort->option = 'view_count' ; $this->sort->direction = 'desc'; break; //view count
            case 3 : $this->sort->option = 'comment_count' ; $this->sort->direction = 'desc'; break; //comment count
            case 4 : $this->sort->option = 'download_count' ; $this->sort->direction = 'desc'; break; //download count
            default : break; //error point
        }
    }

    public function setModelFilter(){
        if($this->searchUser){
            $this->model = $this->model->where('user_id','=',$this->searchUser);
        }
    }

    public function bindData(){
        $this->postWithUser = $this->model->with('users');
        $this->paginator = $this->postWithUser->orderBy($this->sort->option,$this->sort->direction)->paginate($this->pageSize, ['*'], 'page', $this->setPage);
        $this->collection = $this->paginator->getCollection();
    }

    public function getCollection(){
        return $this->collection;
    }
}
