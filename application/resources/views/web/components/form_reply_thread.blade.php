@section('fixed_bottom')
    <div class="container fixed-bottom fixed-reply-form overflow-visible">
    <div class="row d-flex-justify-content-center">
            <button class="btn btn-primary btn-answer-form-show" >Показать форму</button>
            <button class="btn btn-primary btn-answer-form-hide" style="display:none;">Скрыть форму</button>
    </div>
        <form method="POST" class="form_answer_div ajax_form" style="display:none" action="{{ route('site.board.reply',['alias'=>$board->getAlias(),'thread_id'=>$thread->getId()]) }}">

        <div class="card " >
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-4">
                        <label for="exampleFormControlInput1" class="form-label">Имя</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Введите ваше имя">
                    </div>

                </div>
            </div>

            <div class="col-12 mb-2 mt-2">
                <div id="editorjs"></div>
            </div>

            <div class="alert alert-danger form-answer-error" style="display:none">

            </div>
            <div class="d-flex justify-content-center">
                <div class="col-6">
                    <p class="image_captcha">{!! captcha_img() !!}</p>
                    <p><input type="text" name="captcha"></p>
                </div>
                <div class="col-6">
                    {{ csrf_field() }}
                    <input type="hidden" name="editor_js_content" class="editor_js_content">
                    <button class="btn btn-success btn_form" type="submit">Ответить</button>
                </div>
            </div>
        </div>
    </div>
</form>
    </div>

@endsection
@section('footer_js')
    @include("web.scripts.editorjs",["board"=>$board])
@endsection

