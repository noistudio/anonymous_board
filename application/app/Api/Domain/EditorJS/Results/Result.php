<?php

namespace App\Api\Domain\EditorJS\Results;



class Result implements BaseResult
{
    private array $blocks;
    private array $config_blocks;
    private array $config;
    private string $file_path;
    function __construct(array $blocks){

        $this->blocks=$blocks;
        $this->config_blocks=config('editorjs.blocks');
        $this->file_path=config('editorjs.file_config');
        $this->config=$this->getConfig();
        $this->parse();

    }

    private function parse():void{
        $editor = new \EditorJS\EditorJS(json_encode($this->blocks), $this->config['config']);

        $this->blocks['blocks']=$editor->getBlocks();
    }

    private function getConfig():array{
        $config_path=base_path($this->file_path);
        $config = file_get_contents($config_path);
        $array = json_decode($config, true);
        $config = json_encode($array);
        $result = array();
        $result['config'] = $config;
        $result['blocks'] = array();

        return $result;
    }

    public function getBlocks(): array
    {
        // TODO: Implement getBlocks() method.
        return $this->blocks;
    }

    public function getText(): ?string
    {
        // TODO: Implement getText() method.
        $result=null;
        if(isset($this->blocks) and isset($this->blocks['blocks']) and count($this->blocks['blocks'])){
            foreach($this->blocks['blocks'] as $block){
                if(isset($block['type']) and isset($this->config_blocks[$block['type']])){
                    $data=$block['data'] ?? [];

                    $block_class=App()->make($this->config_blocks[$block['type']],["attributes"=>$data]);
                    $result.=" ".$block_class->getString();
                }
            }
        }
        return $result;
    }
    public function getQuote():string{
        $result="";
        if(isset($this->blocks) and isset($this->blocks['blocks']) and count($this->blocks['blocks'])){
            foreach($this->blocks['blocks'] as $block){
                if(isset($block['type']) and isset($this->config_blocks[$block['type']])){
                    $data=$block['data'] ?? [];

                    $block_class=App()->make($this->config_blocks[$block['type']],["attributes"=>$data]);
                    if($quote=$block_class->getQuotedText()){
                        $result.=" ".$quote;
                    }

                }
            }
        }
        return $result;
    }

}
