<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ URL('/') }}/css/weui.css">
    <link rel="stylesheet" href="{{ URL('/') }}/css/book.css">
  <link rel="stylesheet" href="{{ URL('/') }}/css/swipe.css">
</head>
<body>
<div class="page">
  @yield('content')
</div>
<!-- tooltips -->
<div class="bk_toptips"><span></span></div>
<!--BEGIN actionSheet-->
<div id="actionSheet_wrap">
    <div class="weui_mask_transition" id="mask"></div>
    <div class="weui_actionsheet" id="weui_actionsheet">
        <div class="weui_actionsheet_menu">
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(1)">新闻资讯</div>
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(2)">概况一览</div>
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(3)">百度搜索</div>
        </div>
        <div class="weui_actionsheet_action">
            <div class="weui_actionsheet_cell" id="actionsheet_cancel">取消</div>
        </div>
    </div>
</div>
<img class="bk_back" src="{{ URL('/') }}/images/back.png" alt="" onclick="history.go(-1);">
<div class="bk_fix_bottom" onclick="onMenuClick();"></div>
</body>
<script src="{{ URL('/') }}/js/jquery-1.11.2.min.js"></script>
<script src="{{ URL('/') }}/js/swipe.min.js" charset="utf-8"></script>
<script src="{{ URL('/') }}/js/book.js" charset="utf-8"></script>
@yield('my-js')
</html>
