@if(count($messages))
    @foreach($messages as $row)
        <div class="col-12 mb-2 mt-2">
            @include("web.components.message",["thread"=>$row,'board'=>$board])
        </div>
    @endforeach
@else
    <div class="col-12 mb-2 mt-2">
<h4>ответы не найдены!</h4>
    </div>
@endif
