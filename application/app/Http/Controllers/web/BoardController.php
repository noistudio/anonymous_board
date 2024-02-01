<?php

namespace App\Http\Controllers\web;

use App\Api\UI\Board\Repository\BoardRepository;
use App\Api\UI\Thread\Repository\ThreadRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\OpenThreadRequest;
use App\Http\Requests\ReplyThreadRequest;

class BoardController extends Controller
{
    private BoardRepository $board_repository;
    private ThreadRepository $thread_repository;
    public function __construct()
    {
        $this->board_repository=app()->make(BoardRepository::class);
        $this->thread_repository=app()->make(ThreadRepository::class);

    }

    function index($alias){
        $data=[];
        $data['board']=$this->board_repository->getBoard($alias);
        $data['threads']=$this->thread_repository->getAllThreads($data['board'],null,10);
        $data['count']=$this->thread_repository->getCountAllThreads($data['board']);
        $data['offset']=count($data['threads']);

        $data['iscan']=$this->thread_repository->isCan($data['board']);

        return view("web.pages.board",$data);
    }

    function open($alias){
        $data=[];
        $data['board']=$this->board_repository->getBoard($alias);
        $iscan=$this->thread_repository->isCan($data['board']);
        if($iscan==false) return abort(404);

        return view("web.pages.open_thread",$data);
    }

    function reply(ReplyThreadRequest $request){
        $new_thread=$this->thread_repository->replyThread($request);
        $board=$request->getBoard();
        return ["success"=>1];


    }
    function openThread($alias,$thread_id){

        $data['board']=$this->board_repository->getBoard($alias);
        $data['thread']=$this->thread_repository->getThread($data['board'],$thread_id);
        $data['iscan']=$this->thread_repository->isCan($data['board']);

        return view("web.pages.thread",$data);


    }

    function message($alias,$id){
        $data=[];
        $data['board']=$this->board_repository->getBoard($alias);
        $data['message']=$this->thread_repository->getMessage($data['board'],$id);
        $data['first_message']=$this->thread_repository->getMessage($data['board'],$data['message']->getThreadId());

        return view("web.pages.message",$data);
    }

}
