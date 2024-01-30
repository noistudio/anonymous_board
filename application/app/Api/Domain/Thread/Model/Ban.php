<?php

namespace App\Api\Domain\Thread\Model;

class Ban
{
    private int $Id;
    private string $Hash;
    private string $DateTo;
    private int $BoardId;
    public function __construct(int $id,string $Hash,string $DateTo,int $BoardId)
    {
        $this->Id=$id;
        $this->Hash=$Hash;
        $this->BoardId=$BoardId;
        $this->DateTo=$DateTo;
    }
    public function getId():int{
        return $this->Id;
    }
    public function getHash():string{
        return $this->Hash;
    }
    public function getDateTo():string{
        return $this->DateTo;
    }
    public function getBoardId():int{
        return $this->BoardId;
    }

}
