<?php

namespace App\Http\Controllers\web;

use App\Api\UI\Board\Repository\BoardRepository;
use App\Api\UI\Thread\Repository\ThreadRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\OpenThreadRequest;

class AjaxController extends Controller
{

    private BoardRepository  $board_repository;
    private ThreadRepository $thread_repository;

    public function __construct()
    {
        $this->board_repository  = app()->make(BoardRepository::class);
        $this->thread_repository = app()->make(ThreadRepository::class);
    }

    function message($alias, $id)
    {
        $data           = [];
        $data['board']  = $this->board_repository->getBoard($alias);
        $data['thread'] = $this->thread_repository->getMessage($data['board'], $id);

        return view("web.components.message", $data);
    }

    function open_thread(OpenThreadRequest $request)
    {
        $new_thread = $this->thread_repository->openThread($request);
        $board      = $request->getBoard();

        return ["success" => 1, 'url' => route("site.board.thread", ["alias" => $board->getAlias(), "thread_id" => $new_thread->getId()])];
    }

    function answers($alias, $id)
    {
        $board            = $this->board_repository->getBoard($alias);
        $message          = $this->thread_repository->getMessage($board, $id);
        $data             = [];
        $data['board']    = $board;
        $data['messages'] = $this->thread_repository->getAnswers($board, $message);

        return view("web.pages.ajax_answers", $data);
    }

    function generateImg()
    {
        return ["img" => captcha_img()];
    }

    function newMessagesCount($alias, $thread_id, $message_id)
    {
        $board = $this->board_repository->getBoard($alias);
        $count = $this->thread_repository->getCount($board, (int) $thread_id, (int) $message_id);

        return ["count" => $count];
    }

    function loadThreads($alias, $offset)
    {
        $board = $this->board_repository->getBoard($alias);

        $offset  = (int) $offset;
        $rows    = $this->thread_repository->getAllThreads($board, $offset, 10);
        $results = [];
        if (count($rows) > 0)
        {
            foreach ($rows as $row)
            {
                $results[] = view("web.components.message_first", ['board'=>$board,'thread' => $row])->render();
            }
        }

        return ["results" => $results, 'offset' => $offset + count($rows)];
    }

    function newMessages($alias, $thread_id, $message_id)
    {
        $board   = $this->board_repository->getBoard($alias);
        $rows    = $this->thread_repository->getThread($board, (int) $thread_id, (int) $message_id);
        $message = $this->thread_repository->getMessage($board, (int) $thread_id);

        $results = [];
        if (count($rows) > 0)
        {
            foreach ($rows as $row)
            {
                $results[] = view("web.components.message", ['first' => $message, "thread" => $row, 'board' => $board, 'isnew' => true])->render();
            }
        }

        return ["results" => $results];
    }

}
