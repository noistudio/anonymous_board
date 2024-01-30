<form method="POST" class="ajax_form" action="{{ route('ajax.open_thread',$board->getAlias()) }}">
<div class="card">
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
<div class="col-12 mb-2 mt-2">
    <p class="image_captcha">{!! captcha_img() !!}</p>
    <p><input type="text" name="captcha"></p>
</div>
    <div class="alert alert-danger form-answer-error" style="display:none">

    </div>
    <div class="d-flex justify-content-center">
        {{ csrf_field() }}
        <input type="hidden" name="editor_js_content" class="editor_js_content">
        <button class="btn btn-success btn_form" type="submit">Создать</button>
    </div>
</div>
</div>
</form>
@section('footer_js')
    @include("web.scripts.editorjs")
@endsection

