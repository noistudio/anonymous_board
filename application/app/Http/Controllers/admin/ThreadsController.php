<?php

namespace App\Http\Controllers\admin;

use App\Api\Domain\Board\Services\BoardService;
use App\Api\Domain\Thread\Services\ThreadService;
use App\Http\Controllers\Controller;
use App\Models\Threads;

class ThreadsController extends Controller
{
    private ThreadService $thread_service;
    private BoardService  $board_service;
    public function __construct()
    {
        $this->thread_service=app()->make(ThreadService::class);
        $this->board_service=app()->make(BoardService::class);

    }
    function index(){
        $data=[];
        $data['boards']=$this->board_service->getAll();
        if(count($data['boards'])>0){
        $data['current_board']=$data['boards'][0];
        $input_board_alias=request()->input('board_alias');
        if($input_board_alias){
            $data['current_board']=$this->board_service->get($input_board_alias);
        }
        $data['threads']=$this->thread_service->getAll($data['current_board']);

            return view("admin.threads.list",$data);
        }


    }

    function view($alias,$thread_id){
        $data=[];
        $data['board']=$this->board_service->get($alias);
        $data['rows']=$this->thread_service->getThread($data['board'],$thread_id);

        return view("admin.threads.view",$data);
    }

    function delete_message($message_id){

        Threads::query()->where('id',$message_id)->delete();
        return back()->with("success","Сообщение успешно удалено!");
    }
    function delete_thread($thread_id){

        Threads::query()->where('thread_id',$thread_id)->delete();
        return back()->with("success","Тред успешно удален!");
    }

    function toogle_pinned($thread_id){
        $row=Threads::query()->where('id',$thread_id)->firstOrFail();
        if($row->ispinned){
            $row->ispinned=false;
        }else {
            $row->ispinned=true;
        }
        $row->save();
        return back()->with("success","Действие успешно выполнено!");
    }

    function toogle_close($thread_id){
        $row=Threads::query()->where('id',$thread_id)->firstOrFail();
        if($row->isclose){
            $row->isclose=false;
        }else {
            $row->isclose=true;
        }
        $row->save();
        return back()->with("success","Действие успешно выполнено!");
    }
    public function addban(){
        $post_data=request()->post();

        $date_time=new \DateTime($post_data['date_to']);
        $post_data['date_to']=$date_time->format('Y-m-d H:i:s');


        $this->thread_service->addBan($post_data['hash'],$post_data['date_to'],$post_data['board_id']);

        return back()->with("success","Пользователь успешно забанен!");
    }

}
