<a class="button_thread_main" href="{{ route('site.board.thread',["alias"=>$board->getAlias(),"thread_id"=>$thread->getId()]) }}">
<div class="card">
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
    </div>
</div>
<div class="col-12">
    @include("web.components.editorjs_render_mini",["json"=>$thread->getContentJSON()])
</div>
    <div class="row mt-2">

        <div class="col-4">
            <b>Ответов {{ $thread->getCountResponsible() }}</b>
        </div>

        @if($thread->getIsPinned())
        <div class="col-4">
            <b>закреплен</b>
        </div>
        @endif
    </div>
</div>
</div>
</a>

