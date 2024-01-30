@if(isset($json) and isset($json['blocks']) and count($json['blocks']))
   @foreach($json['blocks'] as $block)
       @include("web.components.blocks.".$block['type'],["data"=>$block['data'] ?? []])
   @endforeach
@endif
