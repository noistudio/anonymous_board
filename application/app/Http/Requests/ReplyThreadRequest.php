<?php

namespace App\Http\Requests;

use App\Api\Domain\Board\Model\Board;
use App\Api\Domain\Board\Services\BoardService;
use App\Api\Domain\Thread\Model\Thread;
use App\Api\Domain\Thread\Services\ThreadService;
use App\Rules\EditorJsRule;
use Illuminate\Foundation\Http\FormRequest;

class ReplyThreadRequest extends FormRequest
{
    private ?Board $board=null;
    private ?Thread $thread=null;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'captcha' => 'required|captcha',
            'name'=>'max:100',
            'editor_js_content'=>['required',new EditorJsRule()]
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Максимальная длина Имени 100 символов',
            'name.string'=>'Должно быть строкой',
            'name.alpha_dash'=>'Должны быть только буквы и цифры',
            'editor_js_content.required' => 'Вы не ввели текст сообщения',
            'captcha.required' => 'Капча обязательная для заполнения'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'captcha' => 'Капча',
            'editor_js_content' => 'Сообщение',
        ];
    }

    public function getName():?string{

        if($this->input("name")){
            return strip_tags($this->input("name"));
        }
        return null;
    }
    public function getBlocks():array{
        $editor_js_content=$this->input("editor_js_content");
        $field_array=json_decode($editor_js_content,true);

        return $field_array;
    }
    public function getBoard():Board{
        if(!$this->board){
            $service=app()->make(BoardService::class);
            $this->board=$service->get($this->route('alias'));
            return $this->board;
        }else {
            return $this->board;
        }


    }
    public function getThread():Thread
    {
        if(!$this->thread){
            $service=app()->make(ThreadService::class);
            $this->thread=$service->getFirstMessageThread($this->getBoard(),$this->route('thread_id'));
            return $this->thread;
        }else {
            return $this->board;
        }
    }
}
