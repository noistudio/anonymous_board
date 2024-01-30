<?php

namespace App\Api\UI\Board\Repository;

use App\Api\Domain\Board\Services\BoardService;

class BoardRepository
{
    private BoardService $service;
    public function __construct()
    {
        $this->service=app()->make(BoardService::class);
    }

    public function getAll():array{
        $search_string=request()->input("search");
        return $this->service->getAll($search_string);
    }
    public function getBoard(string $alias){
        return $this->service->get($alias);
    }

}
