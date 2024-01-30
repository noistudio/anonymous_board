@extends("web.layout.main")
@section('content')
    <div class="container">
        <h2 class="text-center pt-2 pb-2">Открыть тред в  {{ $board->getTitle() }}</h2>
        <div class="col-12 mb-2 mt-2 ">
            @include("web.components.form_open_thread",["board"=>$board])
        </div>

    </div>

@endsection
