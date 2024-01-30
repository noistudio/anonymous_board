@extends("web.layout.main")
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("site.board",$board->getAlias()) }}">{{ $board->getTitle() }}</a></li>
                <li class="breadcrumb-item active thread_name" aria-current="page">@include("web.components.title_message",['thread'=>$thread[0],"json"=>$thread[0]->getContentJSON()])</li>
            </ol>
        </nav>


        <div class="row">
            <button type="button" style="display:none" class="btn btn-primary btn-add-to-favorite" data-thread-id="{{ $thread[0]->getThreadId() }}" data-board-alias="{{ $board->getAlias()  }}">Добавить в избранное</button>
        </div>
        <div class="thread_div">
        @if(count($thread))
            @foreach($thread as $row)

                    @include("web.components.message",['first'=>$thread[0],"thread"=>$row,'board'=>$board])

            @endforeach
        @endif
        </div>
        @if(!($thread[0]->getIsClose() or  $iscan==false))
        <div class="col-12 mb-2 mt-2" id="#bottom">

                @include("web.components.form_reply_thread",['board'=>$board,"thread"=>$thread[0]])

        </div>
        @endif

    </div>

@endsection
