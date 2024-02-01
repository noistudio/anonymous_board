@extends("web.layout.main")
@section('meta_title', env('APP_NAME'))
@section('content')
    <div class="container">
        <h2 class="text-center pt-2 pb-2">Доски</h2>
        <div class="col-12">
            @if(count($boards))
                @foreach($boards as $board)
                    @include("web.components.board",["board"=>$board])
                @endforeach
            @else
                <div class="alert alert-danger">
                    ничего не найдено!
                </div>
            @endif

        </div>
    </div>

@endsection
