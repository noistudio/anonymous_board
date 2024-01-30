@if(isset($data['file']) and isset($data['file']['url']) and !str_contains($data['file']['url'],"video"))
<div   class="col-12 mt-4  d-flex justify-content-center @if(isset($data['stretched']) and $data['stretched']==true) w-100 @endif @if(isset($data['withBackground']) and $data['withBackground']==true) image__picture--with-background  @endif">
    <div  class="img_div @if(isset($data['stretched']) and $data['stretched']==true) w-100 @endif"  >
        <img   src="{{ $data['file']['url'] }}"    class="img-fluid mx-auto img-thumbnail @if(isset($data['stretched']) and $data['stretched']==true) image__picture--stretched @endif"  style="max-width: 100%; max-height: 500px;">
        @if(isset($data['caption']) and strlen($data['caption'])>0)
        <p  class="ml-4 mt-4 text-center" >{{ $data['caption'] }}</p>
        @endif
    </div>

</div>
@endif
@if(isset($data['file']) and isset($data['file']['url']) and str_contains($data['file']['url'],"video"))
    <div class="row mt-4 d-flex justify-content-center  @if(isset($data['stretched']) and $data['stretched']==true) w-100 @endif @if(isset($data['withBackground']) and $data['withBackground']==true) image__picture--with-background  @endif " >
        <div class="ml-3 img_div embed-responsive embed-responsive-4by3 @if(isset($data['stretched']) and $data['stretched']==true)   @endif">
            <video controls class="embed-responsive-item @if(isset($data['stretched']) and $data['stretched']==true) image__picture--stretched @endif"  >
                <source id='mp4' src="{{ $data['file']['url'] }}"   />

            </video>
        </div>
        @if(isset($data['caption']) and strlen($data['caption'])>0)
            <p  class="ml-4 mt-4 text-center" >{{ $data['caption'] }}</p>
        @endif
    </div>
@endif
