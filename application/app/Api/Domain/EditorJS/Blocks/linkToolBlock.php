<?php

namespace App\Api\Domain\EditorJS\Blocks;

class linkToolBlock implements BaseBlock
{
    private String $Link;
    public function __construct(array $attributes)
    {
        $this->Link=$attributes['link'];
    }

    public function getString(): ?string
    {
        return $this->Link;
        // TODO: Implement getString() method.
    }
    public function getQuotedText():?string{

        if(str_contains($this->Link,env('APP_URL').'/message/')){
            $need_id=str_replace(env('APP_URL').'/message/',"",$this->Link);
            $need_id=explode("/",$need_id)[1];
            return "[".$need_id."]";
        }
        return null;
    }

}
