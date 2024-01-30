@if(isset($json) and isset($json['blocks']) and count($json['blocks']))
    @for ($i = 0; $i < 4; $i++)
        @if(isset($json['blocks'][$i]))
            @include("web.components.blocks.".$json['blocks'][$i]['type'],["data"=>$json['blocks'][$i]['data'] ?? []])
        @endif
    @endfor
@endif
