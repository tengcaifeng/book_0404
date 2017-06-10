@extends('master')

@section('title', $product->name)

@section('content')
<div class="content" style="top: 0px;bottom:0px;">
  <div class="addWrap">
    <div class="swipe" id="mySwipe">
      <div class="swipe-wrap">
        @foreach($pdt_images as $pdt_image)
        <div>
          <a href="javascript:;"><img class="img-responsive" src="{{URL('/').$pdt_image->image_path}}" /></a>
        </div>
        @endforeach
      </div>
    </div>
    <ul id="position">
      @foreach($pdt_images as $index => $pdt_image)
        <li class={{$index == 0 ? 'cur' : ''}}></li>
      @endforeach
    </ul>
  </div>
  <div class="weui_cells_title">
   <p style="font-size: 24px;color:#000;">{{$product->name}} </p>
   <p> 作者:劲枫&nbsp; {{ $product->created_at }}</p>
  </div>
  <div class="weui_cells" style="margin: 0 auto;padding:5px;">
    <div class="formControls col-8" style="width: 100%;">
      @if($pdt_content != '')
        {!! $pdt_content->content !!}
      @else
        {{ '没有更多内容' }}
      @endif
    </div>
  </div>
</div>
<div class="bk_fix_bottom">
</div>
@endsection
@section('my-js')
<script type="text/javascript">
  var bullets = document.getElementById('position').getElementsByTagName('li');
  Swipe(document.getElementById('mySwipe'), {
    auto: 2000,
    continuous: true,
    disableScroll: false,
    callback: function(pos) {
      var i = bullets.length;
      while (i--) {
        bullets[i].className = '';
      }
      bullets[pos].className = 'cur';
    }
  });
</script>
@endsection
