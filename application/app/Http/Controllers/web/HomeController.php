<?php

namespace App\Http\Controllers\web;

use App\Api\UI\Board\Repository\BoardRepository;

class HomeController extends \App\Http\Controllers\Controller
{
    private BoardRepository $repository;
    public function __construct()
    {
        $this->repository=app()->make(BoardRepository::class);
    }

    function index(){
        $data=[];
        $data['boards']=$this->repository->getAll();

        return view('web.pages.home',$data);
    }

}
