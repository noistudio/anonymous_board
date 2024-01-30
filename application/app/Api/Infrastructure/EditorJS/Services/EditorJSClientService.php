<?php

namespace App\Api\Infrastructure\EditorJS\Services;

use App\Api\Domain\EditorJS\Results\BaseResult;
use App\Api\Domain\EditorJS\Results\Result;
use App\Api\Domain\EditorJS\Services\EditorJSService;

class EditorJSClientService implements EditorJSService
{

    public function getResult(array|string $blocks): BaseResult
    {
        if(is_string($blocks)){
            $blocks=json_decode($blocks,true);

        }
        $result=new Result($blocks);
        return $result;
    }

}
