@extends('admin.master')

@section('content')

  <style>
    .row.cl {
      margin: 20px 0;
    }
  </style>

  <form class="form form-horizontal" action="" method="post"  id="form-product-edit">
    {{ csrf_field() }}
      <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>名称：</label>
      <div class="formControls col-5">
        <input  class="input-text"  type="text" name="name" value="{{$product->name}}"  datatype="*" nullmsg="简介不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>简介：</label>
      <div class="formControls col-5">
          <input type="text" class="input-text" value="{{$product->summary}}" placeholder="" name="summary" >
      </div>
      <div class="col-4"> </div>
    </div>
          <div class="row cl weui_cell_select">
              <label class="form-label col-3"><span class="c-red"></span>类别：</label>
              <div class="weui_cell_bd weui_cell_primary">
                  <select class="weui_select" name="category_id">
                      <option value="{{$product->category_id}}">{{ $category_row->name }}</option>
                      @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
 <div class="row cl">
      <label class="form-label col-3">预览图：</label>
     <div class="formControls col-5">
         @if($product->preview != null)
             <img id="preview_id" src="{{$product->preview}}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id').click()" />
         @else
             <img id="preview_id" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id').click()" />
         @endif
         <input type="file" name="file" id="input_id" style="display: none;" onchange="return uploadImageToServer('input_id','images', 'preview_id');" />
     </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3">详细内容：</label>
      <div class="formControls col-8">
        <textarea name="content" id="myEditor">{{ $pdt_content->content }}</textarea>
      </div>
    </div>

    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
@endsection

@section('my-js')
  <script type="text/javascript">
      var ue = UE.getEditor('myEditor');
      ue.execCommand( "getlocaldata" );

      $("#form-product-edit").Validform({
          tiptype:2,
          callback:function(form){
              $('#form-product-edit').ajaxSubmit({
                  type: 'post', // 提交方式 get/post
                  url: '/admin/service/product/edit', // 需要提交的 url
                  dataType: 'json',
                  data: {
                      id: $('input[name=id]').val(),
                      name: $('input[name=name]').val(),
                      summary: $('input[name=summary]').val(),
                      //price: $('input[name=price]').val(),
                      category_id: $('select[name=category_id] option:selected').val(),
                      preview: ($('#preview_id').attr('src')!='/admin/images/icon-add.png'?$('#preview_id').attr('src'):''),
                      content: ue.getContent(),
                      _token: "{{csrf_token()}}"
                  },
                  success: function(data) {
                      if(data == null) {
                          layer.msg('服务端错误', {icon:2, time:2000});
                          return;
                      }
                      if(data.status != 0) {
                          layer.msg(data.message, {icon:2, time:2000});
                          return;
                      }

                      layer.msg(data.message, {icon:1, time:2000});
                      parent.location.reload();
                  },
                  error: function(xhr, status, error) {
                      console.log(xhr);
                      console.log(status);
                      console.log(error);
                      layer.msg('ajax error', {icon:2, time:2000});
                  },
                  beforeSend: function(xhr){
                      layer.load(0, {shade: false});
                  },
              });

              return false;
          }
      });
  </script>
@endsection
