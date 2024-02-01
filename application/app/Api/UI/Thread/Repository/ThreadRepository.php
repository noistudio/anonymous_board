<?php

namespace App\Api\UI\Thread\Repository;

use App\Api\Domain\Board\Model\Board;
use App\Api\Domain\EditorJS\Services\EditorJSService;
use App\Api\Domain\Thread\Model\Thread;
use App\Api\Domain\Thread\Services\ThreadService;
use App\Http\Requests\OpenThreadRequest;
use App\Http\Requests\ReplyThreadRequest;

class ThreadRepository
{
    private ThreadService $service;
    private EditorJSService $editorjs;
    function __construct()
    {
        $this->service=app()->make(ThreadService::class);
        $this->editorjs=app()->make(EditorJSService::class);

    }

    function getAllThreads(Board $board,int|null $offset=null,int|null $limit=null){
        $search_string=request()->input("search");
        return $this->service->getAll($board,$search_string,$offset,$limit);
    }
    function getCountAllThreads(Board $board){
        $search_string=request()->input("search");
        return $this->service->getCountAll($board,$search_string);
    }

    function getCount(Board $board,$thread_id,$message_id=null){
        $search_string=request()->input("search");
        return $this->service->getCountMessages($board,(int)$thread_id,$search_string,$message_id);
    }
    function getThread(Board $board,$thread_id,$message_id=null){
        $search_string=request()->input("search");
        return $this->service->getThread($board,(int)$thread_id,$search_string,$message_id);
    }
    function getAnswers(Board $board,Thread $thread){
        return $this->service->getAnswers($board,$thread);
    }

    function replyThread(ReplyThreadRequest $request){
        $board=$request->getBoard();
        $thread=$request->getThread();
        $new_thread=new Thread();
        $new_thread->setIsMain(false);
        if($name=$request->getName()){
            $new_thread->setName($name);
        }
        $new_thread->setThreadId($thread->getId());
        $new_thread->setBoardId($board->getId());
        $result=$this->editorjs->getResult($request->getBlocks());
        $new_thread->setBoardId($board->getId());
        $new_thread->setContentJSON($result->getBlocks());
        if($text=$result->getText())
        {
            $new_thread->setContentTxT($text);
        }
        $new_thread->setQuotedText($result->getQuote());

        $new_thread=$this->service->addToThread($new_thread);

        return $new_thread;
    }
    function getMessage(Board $board,Int $id){
        return $this->service->getFirstMessageThread($board,$id);
    }
    function openThread(OpenThreadRequest $request){
        $board=$request->getBoard();
        $new_thread=new Thread();
        $new_thread->setIsMain(true);
        if($name=$request->getName()){
            $new_thread->setName($name);
        }
        $new_thread->setBoardId($board->getId());
        $result=$this->editorjs->getResult($request->getBlocks());
        $new_thread->setBoardId($board->getId());
        $new_thread->setContentJSON($result->getBlocks());
        if($text=$result->getText())
        {
            $new_thread->setContentTxT($text);
        }

        $new_thread=$this->service->createThread($new_thread);

        return $new_thread;
    }
    function isCan(Board $board){
        return $this->service->isCan($board);
    }



}
