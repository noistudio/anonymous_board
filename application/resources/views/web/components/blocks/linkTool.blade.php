<div class="renderce-block mb-3" >
    <div class="renderce-block__content" >
        <div class="cdx-block">
            <div class="link-tool">
                <div class="link-tool__content link-tool__content--rendered before_click_link" target="_blank" data-link="{{ $data['link'] }}" rel="nofollow noindex noreferrer">
                    @if(isset($data['meta']) && isset($data['meta']['image']) && isset($data['meta']['image']['url']))
                    <div class="link-tool__image"  style="background-image: url({{ $data['meta']['image']['url'] }});"></div>
                    @endif
                    @if(isset($data['link']) && isset($data['meta']) && isset($data['meta']['title']))
                    <a class="link-tool__title" target="_blank" href="{{ $data['link'] }}" >{{ $data['meta']['title'] }}</a>
                    @endif
                    @if(isset($data['meta']) && isset($data['meta']['description']))
                    <p class="link-tool__description" >{{ $data['meta']['description'] }} </p>
                    @endif
                    @if(isset($data['meta']) && isset($data['meta']['site_name']))
                    <span class="link-tool__anchor" >{{ $data['meta']['site_name']  }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
