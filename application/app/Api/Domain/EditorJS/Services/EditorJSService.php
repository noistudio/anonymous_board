<?php

namespace App\Api\Domain\EditorJS\Services;

use App\Api\Domain\EditorJS\Results\BaseResult;

interface EditorJSService
{

    public function getResult(array|string $blocks):BaseResult;
}
