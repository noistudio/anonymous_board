<?php

namespace App\Http\Controllers\editorjs;

use App\Api\UI\EditorJS\LinkToolRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkEditorJsRequest;

class LinkToolController extends Controller
{
    function index(LinkEditorJsRequest $request){
        return app()->make(LinkToolRepository::class)->fetch($request);
    }

}
