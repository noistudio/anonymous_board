@extends("web.layout.main")
@section('meta_title', "Доска ".$board->getTitle())
@section('content')
    <div class="container thread_list_data" data-board-alias="{{ $board->getAlias() }}" data-count="{{ $count }}" data-offset="{{ $offset }}">
        <h2 class="text-center pt-2 pb-2">Доска {{ $board->getTitle() }}</h2>
        <div class="col-12 mb-2 mt-2">
            @if($iscan)
            <div class="d-flex justify-content-end">

                <a href="{{ route('site.board.open',["alias"=>$board->getAlias()]) }}" class="btn btn-primary">Открыть тред</a>
            </div>
            @endif
        </div>
        @if(empty($threads))
            <div class="d-flex justify-content-center alert alert-info">
                <h2>Треды не найдены</h2>
            </div>
        @endif

        @if(count($threads))
            <div class="col-12 mb-2 mt-2 list_threads">
            @foreach($threads as $thread)

                  @include("web.components.message_first",["thread"=>$thread,'board'=>$board])

            @endforeach
            </div>
        @endif

    </div>

@endsection
