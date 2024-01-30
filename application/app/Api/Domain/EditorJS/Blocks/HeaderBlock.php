<?php

namespace App\Api\Domain\EditorJS\Blocks;

class HeaderBlock implements BaseBlock
{
    private String $Text;
    public function __construct(array $attributes)
    {
        $this->Text=$attributes['text'];
    }

    public function getString(): ?string
    {
        return $this->Text;
        // TODO: Implement getString() method.
    }
    public function getQuotedText():?string{
        return null;
    }

}
