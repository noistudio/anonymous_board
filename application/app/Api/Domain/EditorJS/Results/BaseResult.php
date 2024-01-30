<?php

namespace App\Api\Domain\EditorJS\Results;

interface BaseResult
{
    function __construct(array $blocks);

    public function getBlocks():array;
    public function getText():?string;
    public function getQuote():string;
}
