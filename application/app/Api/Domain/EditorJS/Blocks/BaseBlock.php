<?php

namespace App\Api\Domain\EditorJS\Blocks;

interface BaseBlock
{
    function __construct(Array $attributes);

    public function getString():?string;

    public function getQuotedText():?string;

}
