<?php
namespace App\Api\Domain\Board\Services;

use App\Api\Domain\Board\Model\Board;

/**
 *
 */
interface BoardService
{


    /**
     * @return array
     */
    public function getAll(?String $search_value=null):array;

    public function get(string $alias):Board;




}
