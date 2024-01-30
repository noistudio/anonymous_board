 <div class="card message_thread" data-url="{{ route("ajax.newMessages",["alias"=>$board->getAlias(),"thread_id"=>$thread->getThreadId(),"message_id"=>$thread->getId()]) }}" data-board-alias="{{ $board->getAlias() }}" data-thread-id="{{ $thread->getThreadId() }}" data-message-id="{{ $thread->getId() }}">
        <div class="card-body">

            <div class="row">
                <div class="col-5">

                    @if($name=$thread->getName())
                        <b>{{ $name }}</b>
                    @else
                        <b>Анонимус</b>
                    @endif
                </div>
                <div class="col-7">
                    {{ $thread->getCreatedAt() }}
                    @if(isset($isnew) and $isnew==true)
                        [NEW]
                    @endif
                </div>
            </div>
            <div class="col-12">
                @include("web.components.editorjs_render",["json"=>$thread->getContentJSON()])
            </div>
            <div class="row mt-2">
                @if(!(isset($notreply)) and  !$first->getIsClose() )
                <div class="col-4">
                    <a href="#" data-name="#{{ $thread->getId() }}" data-link="{{ route('site.board.message',['alias'=>$board->getAlias(),'id'=>$thread->getId()]) }}" class="btn-quote-action btn btn-primary">Ответить</a>
                </div>
                @endif
                <div class="col-4">
                <a href="{{ route('site.board.message',['alias'=>$board->getAlias(),'id'=>$thread->getId()]) }}">#{{ $thread->getId() }}</a>
                </div>
                <div class="col-4">
                    @if($thread->getCountResponsible()>0)
                     <button data-id="{{ $thread->getId() }}" class="btn btn-primary btn_load_answers" data-link="{{ route('ajax.answers',['alias'=>$board->getAlias(),'id'=>$thread->getId()]) }}">Ответов {{ $thread->getCountResponsible() }}</button>
                    @else
                    <b>Ответов {{ $thread->getCountResponsible() }}</b>
                    @endif
                </div>
            </div>
        </div>
    </div>

