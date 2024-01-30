@extends("web.layout.main")
@section('content')
    <div class="container  " >
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("site.board",$board->getAlias()) }}">{{ $board->getTitle() }}</a></li>


                    <li class="breadcrumb-item"><a href="{{ route('site.board.thread',['alias'=>$board->getAlias(),'thread_id'=>$message->getThreadId()]) }}">@include("web.components.title_message",['thread'=>$first_message,"json"=>$first_message->getContentJSON()])</a></li>
                     <li class="breadcrumb-item active" aria-current="page">#{{ $message->getId() }}</li>

            </ol>
        </nav>




        <div class="col-12 mb-2 mt-2">
            @include("web.components.message",["thread"=>$message,'notreply'=>true])
        </div>


    </div>

@endsection
