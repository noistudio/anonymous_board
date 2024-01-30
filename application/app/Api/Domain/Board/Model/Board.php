<?php

namespace App\Api\Domain\Board\Model;

/**
 *
 */
class Board
{

    /**
     * @var string
     */
    private string  $title;
    /**
     * @var string
     */
    private string  $alias;
    /**
     * @var Int
     */
    private Int     $id;
    /**
     * @var string|null
     */
    private ?string $description;

    /**
     * @param string      $title
     * @param string      $alias
     * @param Int         $id
     * @param string|null $description
     */
    public function __construct(string $title, string $alias, Int $id, ?string $description=null)
    {
        $this->title=$title;
        $this->alias=$alias;
        $this->id=$id;
        $this->description=$description;
    }

    /**
     * @return string
     */
    public function getTitle():string{

        return $this->title;
    }

    /**
     * @return string
     */
    public function getAlias():string{
        return $this->alias;
    }

    /**
     * @return Int
     */
    public function getId():Int{
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getDescription():?string{
        return $this->description;
    }




}
