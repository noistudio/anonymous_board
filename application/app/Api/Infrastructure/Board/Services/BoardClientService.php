<?php
namespace App\Api\Infrastructure\Board\Services;

use App\Api\Domain\Board\Model\Board;
use App\Models\Boards;
use \Illuminate\Database\Eloquent\Builder;
class BoardClientService implements \App\Api\Domain\Board\Services\BoardService
{


    public function get(string $alias):Board{
        $row=Boards::query()->where('enable',true)->where('alias',$alias)->firstOrFail();

        return new Board($row->title,$row->alias,$row->id,$row->description ?? null);

    }
    public function getAll(?String $search_value=null): array
    {
        $parent=$this;
        $rows=Boards::query()->where('enable',true)->where(function(Builder $query) use ($search_value){
            if($search_value){
                $query->orWhere("title","like",$search_value);
                $query->orWhere("title","like","%".$search_value);
                $query->orWhere("title","like",$search_value."%");
                $query->orWhere("title","like","%".$search_value."%");
                $query->orWhere("description","like",$search_value);
                $query->orWhere("description","like","%".$search_value);
                $query->orWhere("description","like",$search_value."%");
                $query->orWhere("description","like","%".$search_value."%");
            }
        })->get();
        $results=[];
        if(count($rows)){
            foreach($rows as $row){
                $results[]=new Board($row->title,$row->alias,$row->id,$row->description ?? null);

            }
        }

        return $results;
    }

}
