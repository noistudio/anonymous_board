<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <a href="{{ route("site.board",$board->getAlias()) }}"><p>{{ $board->getTitle() }}</p></a>
            </div>
            <div class="col-8">
                {!! $board->getDescription(); !!}
            </div>
        </div>
    </div>
</div>
