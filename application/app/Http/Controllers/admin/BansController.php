<?php

namespace App\Http\Controllers\admin;

use App\Api\Domain\Thread\Model\Ban;
use App\Api\Domain\Thread\Services\ThreadService;
use App\Http\Controllers\Controller;
use App\Models\Banned;

class BansController extends Controller
{
    private ThreadService $service;

    function __construct()
    {
        $this->service=app()->make(ThreadService::class);
    }

    function index(){

        $data=[];


        $ip=request()->input("ip");
        $data['bans']=$this->service->getBanned($ip);
        $data['ip']=$ip;
        return view("admin.bans.list",$data);

    }
    function remove($id){
        Banned::query()->where('id',$id)->delete();
        return back()->with("success","Блокировка успешно удалена!");
    }
}
