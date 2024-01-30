<?php

namespace App\Api\Infrastructure\Thread\Services;

use App\Api\Domain\Board\Model\Board;
use App\Api\Domain\Thread\Model\Ban;
use App\Api\Domain\Thread\Model\Thread;
use App\Models\Banned;
use App\Models\Threads;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ThreadClientService implements \App\Api\Domain\Thread\Services\ThreadService
{

    private function parse(Threads $row):Thread{

        $thread=new Thread();
        $thread->setId($row->id);
        $thread->setBoardId($row->board_id);
        $thread->setIsMain((bool)$row->ismain);
        if($row->thread_id){
            $thread->setThreadId($row->thread_id);
        }
        if($row->id_reply){
            $thread->setIdReply($row->id_reply);
        }
        if($row->name){
            $thread->setName($row->name);
        }
        if($row->created_at){
            $thread->setCreatedAt($row->created_at);
        }
        if($row->ispinned){
            $thread->setIsPinned($row->ispinned);
        }
        if($row->isclose){
            $thread->setIsClose($row->isclose);
        }

        $thread->setContentJSON($row->content_json);
        if($row->content_txt){
            $thread->setContentTxT($row->content_txt);
        }

        $thread->setHash($row->hash);
        if($row->response_count){
            $thread->setCountResponsible($row->response_count);
        }
        if($row->posts_count>0){
            $thread->setCountResponsible($row->posts_count);
        }
        return $thread;
    }
    /**
     * @inheritDoc
     */
    public function getAll(Board $board,?String $search_value=null): array
    {

        $rows=Threads::query()->withCount("posts")->where(function(Builder $query) use ($board){
            $query->where('board_id',$board->getId());
            $query->where("ismain",true);

        })->where(function(Builder $query) use ($search_value){
            if($search_value){
                $query->orWhere("content_txt","like",$search_value);
                $query->orWhere("content_txt","like","%".$search_value);
                $query->orWhere("content_txt","like",$search_value."%");
                $query->orWhere("content_txt","like","%".$search_value."%");
            }
        })->orderByDesc("ispinned")->orderByDesc("updated_at")->get();

        $result=[];
        if(count($rows)){
            foreach($rows as $row){
            $thread=$this->parse($row);
            $result[]=$thread;

            }
        }

        return $result;
    }
    public function getFirstMessageThread(Board $board,int $Id):Thread
    {
        $thread=Threads::query()->select('threads.*')->selectSub(function ($query)  {
            $query->from('threads as t2')
                  ->selectRaw('COUNT(*) as count_answers')
                  ->whereRaw("t2.quoted_text LIKE CONCAT('%[', threads.id, ']%')");
        }, 'response_count')->where('board_id',$board->getId())->where('id',$Id)->firstOrFail();

        return $this->parse($thread);

    }
    public function getAnswers(Board $board,Thread $thread):array{

        $posts=Threads::query()->select('threads.*')->selectSub(function ($query) use($thread) {
            $query->from('threads as t2')
                  ->selectRaw('COUNT(*) as count_answers')
                  ->where('t2.thread_id', $thread->getThreadId())
                  ->whereRaw("t2.quoted_text LIKE CONCAT('%[', threads.id, ']%')");
        }, 'response_count')->where('thread_id',$thread->getThreadId())->where('quoted_text','like',"%[".$thread->getId()."]%")->get();
        $result=[];
        if($posts && count($posts)>0){
            foreach($posts as $post){
                $result[]=$this->parse($post);
            }
        }
        return $result;
    }
    public function getCountMessages(Board $board,Int $Id,?String $search_value=null,?int $lastMessageId=null):int{
        $count=Threads::query()->where('thread_id',$Id)->where(function(Builder $query) use ($search_value){
            if($search_value){
                $query->orWhere("content_txt","like",$search_value);
                $query->orWhere("content_txt","like","%".$search_value);
                $query->orWhere("content_txt","like",$search_value."%");
                $query->orWhere("content_txt","like","%".$search_value."%");
            }
        })->where(function(Builder $query) use ($lastMessageId){
            if($lastMessageId){
                $query->where('id',">",$lastMessageId);
            }
        })->orderByDesc("ismain")->orderBy("created_at")->count();

        return $count;

    }
    public function getThread(Board $board,int $Id,?String $search_value=null,?int $lastMessageId=null): array
    {

        $posts=Threads::query()->select('threads.*')->selectSub(function ($query) use($Id) {
            $query->from('threads as t2')
                  ->selectRaw('COUNT(*) as count_answers')
                  ->where('t2.thread_id', $Id)
                  ->whereRaw("t2.quoted_text LIKE CONCAT('%[', threads.id, ']%')");
        }, 'response_count')->where('thread_id',$Id)->where(function(Builder $query) use ($search_value){
            if($search_value){
             $query->orWhere("content_txt","like",$search_value);
             $query->orWhere("content_txt","like","%".$search_value);
             $query->orWhere("content_txt","like",$search_value."%");
             $query->orWhere("content_txt","like","%".$search_value."%");
            }
        })->where(function(Builder $query) use ($lastMessageId){
            if($lastMessageId){
            $query->where('id',">",$lastMessageId);
            }
        })->orderByDesc("ismain")->orderBy("created_at")->get();

        $result=[];


         if($posts && count($posts)>0){
             foreach($posts as $post){
                 $result[]=$this->parse($post);
             }
         }


        return $result;
        // TODO: Implement getThread() method.
    }

    public function addToThread(Thread $thread): Thread
    {

        $array=$thread->toArray();
        Threads::query()->where('id',$thread->getThreadId())->update(
            ["updated_at"=>Carbon::today()->toDateTimeString()]
        );
        $array['hash']=hash('sha512', request()->ip());
        $new_row=Threads::create($array);
        return $this->parse($new_row);
    }

    public function createThread(Thread $thread): Thread
    {
        $array=$thread->toArray();
        $array['hash']=hash('sha512', request()->ip());
        $new_row=Threads::create($array);
        $new_row->thread_id=$new_row->id;
        $new_row->save();
        return $this->parse($new_row);

    }
    public function isCan(Board $board):bool{
      $hash=hash('sha512', request()->ip());
      $current_time=date('Y-m-d H:i:s',time());
      $count=Banned::query()->where('hash',$hash)->where('date_to',">=",$current_time)->where(function(Builder $query) use ($board){
         $query->orWhere("board_id",0);
         $query->orWhere("board_id",$board->getId());
      })->count();

      if($count){
          return false;
      }else {
          return true;
      }


    }
    public function getBanned($ip=null):array{
        $banned=Banned::query()->where(function (Builder $query) use ($ip){
            if($ip){
                $query->where('hash',hash('sha512', $ip));
            }
        })->get();
        $result=[];
        if(count($banned)){
            foreach($banned as $ban){
                $new_ban=new Ban($ban->id,$ban->hash,$ban->date_to,$ban->board_id);
                $result[]=$new_ban;
            }
        }

        return $result;
    }

    public function addBan($hash,$date_to,$board_id):Ban{
        $banned=new Banned();
        $banned->hash=$hash;
        $banned->date_to=$date_to;
        $banned->board_id=$board_id;
        $banned->save();

        return new Ban($banned->id,$banned->hash,$banned->date_to,$banned->board_id);

    }

}
