<?php

namespace App\Api\Domain\Thread\Model;

/**
 *
 */
class Thread
{

    /**
     * @var int
     */
    private ?int $Id=null;
    /**
     * @var int
     */
    private ?int $ThreadId=null;
    private ?int $BoardId=null;
    /**
     * @var bool
     */
    private bool $IsMain=false;

    /**
     * @var bool
     */
    private bool $IsPinned=false;

    /**
     * @var bool
     */
    private bool $IsClose=false;
    /**
     * @var int|null
     */
    private ?int $IdReply=null;
    /**
     * @var string|null
     */
    private ?string $Name=null;
    /**
     * @var array
     */
    private array $ContentJSON;

    private ?string $QuotedText=null;
    /**
     * @var string
     */
    private ?string $ContentTxT=null;

    /**
     * @var string
     */
    private string $Hash;

    private ?string $createdAt;

    private ?int $CountResponsible=0;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->Id = $id;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->Id;
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function setThreadId(int $ThreadId): void
    {
        $this->ThreadId = $ThreadId;
    }

    /**
     * @return int
     */
    public function getThreadId(): ?int
    {
        return $this->ThreadId;
    }

    /**
     * @param int $BoardId
     *
     * @return void
     */
    public function setBoardId(int $BoardId): void
    {
        $this->BoardId = $BoardId;
    }

    /**
     * @return int
     */
    public function getBoardId(): int
    {
        return $this->BoardId;
    }

    /**
     * @param bool $isMain
     *
     * @return void
     */
    public function setIsMain(bool $isMain): void
    {
        $this->IsMain = $isMain;
    }

    /**
     * @return bool
     */
    public function getIsMain(): bool
    {
        return $this->IsMain;
    }

    /**
     * @param bool $IsPinned
     *
     * @return void
     */
    public function setIsPinned(bool $IsPinned): void
    {
        $this->IsPinned = $IsPinned;
    }

    /**
     * @return bool
     */
    public function getIsPinned(): bool
    {
        return $this->IsPinned;
    }

    /**
     * @param bool $IsClose
     *
     * @return void
     */
    public function setIsClose(bool $IsClose): void
    {
        $this->IsClose = $IsClose;
    }

    /**
     * @return bool
     */
    public function getIsClose(): bool
    {
        return $this->IsClose;
    }

    /**
     * @param int $IdReply
     *
     * @return void
     */
    public function setIdReply(int $IdReply): void
    {
        $this->IdReply = $IdReply;
    }


    public function setCountResponsible(int $count): void
    {
        $this->CountResponsible=$count;
    }

    public function getCountResponsible():int{
       return $this->CountResponsible;
    }

    /**
     * @return int
     */
    public function getIdReply(): ?int
    {
        return $this->IdReply;
    }

    /**
     * @param string $Name
     *
     * @return void
     */
    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->Name;
    }

    /**
     * @param array $ContentJSON
     *
     * @return void
     */
    public function setContentJSON(array $ContentJSON): void
    {
        $this->ContentJSON = $ContentJSON;
    }

    /**
     * @return array
     */
    public function getContentJSON(): array
    {
        return $this->ContentJSON;
    }

    public function setQuotedText(string $quote_text):void{
      $this->QuotedText=$quote_text;
    }
    public function getQuotedText():?string{
       return  $this->QuotedText;
    }

    /**
     * @param string $ContentTxT
     *
     * @return void
     */

    public function setContentTxT(string $ContentTxT): void
    {
        $this->ContentTxT = $ContentTxT;
    }

    /**
     * @return string
     */
    public function getContentTxT(): ?string
    {
        return $this->ContentTxT;
    }

    /**
     * @param string $Hash
     *
     * @return void
     */

    public function setHash(string $Hash): void
    {
        $this->Hash = $Hash;
    }

    public function getHash(): string
    {
        return $this->Hash;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt():string{
        return $this->createdAt;
    }

    public function toArray():array{
        $result=[];
        if($Id=$this->getId()){
            $result['id']=$Id;
        }
        if($BoardId=$this->getBoardId()){
            $result['board_id']=$BoardId;
        }

        if($ThreadId=$this->getThreadId()){
            $result['thread_id']=$ThreadId;
        }

        $result['ismain']=$this->getIsMain();

        if($IdReply=$this->getIdReply()){
         $result['id_reply']=$IdReply;
        }

        if($Name=$this->getName()){
            $result['name']=$Name;
        }
        $result['content_json']=$this->getContentJSON();
        if($content_txt=$this->getContentTxT())
        {
            $result['content_txt'] = $this->getContentTxT();
        }
        if($quoted_text=$this->getQuotedText()){
         $result['quoted_text']=$quoted_text;
        }





        return $result;
    }



}
