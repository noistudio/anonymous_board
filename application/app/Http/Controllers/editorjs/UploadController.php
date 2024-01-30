<?php

namespace App\Http\Controllers\editorjs;

use App\Api\UI\EditorJS\UploadRepository;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    private UploadRepository $repository;
    public function __construct()
    {
        $this->repository=app()->make(UploadRepository::class);
    }

    public function imageVideo(){
        return $this->repository->ImageVideo();
    }
}
