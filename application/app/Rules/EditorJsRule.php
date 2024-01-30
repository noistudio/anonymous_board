<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EditorJsRule implements Rule
{
    private string $file_path;
    private array $config;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->file_path=config('editorjs.file_config');
        $this->config=$this->getConfig();


    }

    private function getConfig(){
        $config_path=base_path($this->file_path);
        $config = file_get_contents($config_path);
        $array = json_decode($config, true);
        $config = json_encode($array);
        $result = array();
        $result['config'] = $config;
        $result['blocks'] = array();

        return $result;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(is_array($value))
        {
            $value = json_encode($value);
        }

        try{

            $editor = new \EditorJS\EditorJS($value, $this->config['config']);

            $blocks=$editor->getBlocks();
            if(!(isset($blocks) and is_array($blocks) and count($blocks)>0)){
                return false;
            }
            return true;
        }catch(\Exception $exception){
            echo $exception->getMessage();
            exit;
        }

        return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Не правильно заполнены данные!';
    }
}
