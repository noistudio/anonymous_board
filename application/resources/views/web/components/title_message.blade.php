@if($thread->getContentTxt())
@foreach($json['blocks'] as $block)
    @if($block['type']=="header")
        {{ $block['data']['text'] }}
        @break
    @endif
    @if($block['type']=="paragraph")
        {{ $block['data']['text'] }}
        @break
    @endif
@endforeach
@else
 #{{ $thread->getThreadId() }}
@endif
