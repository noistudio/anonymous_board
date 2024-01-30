<?php

namespace App\Api\Domain\Thread\Services;

use App\Api\Domain\Board\Model\Board;
use App\Api\Domain\Thread\Model\Ban;
use App\Api\Domain\Thread\Model\Thread;

/**
 *
 */
interface ThreadService
{

    /**
     * @param Board $board
     *
     * @return array
     */
    public function getAll(Board $board,?String $search_value=null):array;

    public function getCountMessages(Board $board,Int $Id,?String $search_value=null,?int $lastMessageId=null):int;

    public function getThread(Board $board,Int $Id,?String $search_value=null,?int $lastMessageId=null):array;
    public function getFirstMessageThread(Board $board,int $id):Thread;
    public function getAnswers(Board $board,Thread $thread):array;
    public function addToThread(Thread $thread):Thread;
    public function createThread(Thread $thread):Thread;

    public function isCan(Board $board):bool;

    public function getBanned($ip=null):array;

    public function addBan($hash,$date_to,$board_id):Ban;





}
