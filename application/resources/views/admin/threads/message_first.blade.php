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
            <p><a class="btn" href="{{ route('admin.threads.toogle_pinned',$thread->getThreadId()) }}">@if($thread->getIsPinned()) открепить @else закрепить @endif</a>
            </p>
            <p><a class="btn" href="{{ route('admin.threads.toogle_close',$thread->getThreadId()) }}">@if($thread->getIsClose()) открыть тред @else закрыть тред @endif</a></p>
       </div>
        <div class="col-4">
            <a class="btn btn-primary" href="{{ route('admin.threads.view',['alias'=>$board->getAlias(),'thread_id'=>$thread->getThreadId()]) }}">Открыть тред</a>
        </div>
        <div class="col-4">
            <a class="btn btn-danger" href="{{ route('admin.threads.delete_thread',$thread->getThreadId()) }}">Удалить тред</a>
        </div>
    </div>
</div>
</div>


