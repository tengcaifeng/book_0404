@extends('master')

@section('title', '新闻资讯')

@section('content')
<link rel="stylesheet" href="/css/cangxi_new.css">
<div class="find_nav">
    <div class="find_nav_left">
        <div class="find_nav_list">
            <ul id="pagenavi1">
               @foreach($show_name as $v)
                    <li><a href="#">{{ $v->name }}</a></li>
                @endforeach
                <li class="sideline" ></li>
            </ul>
        </div>
    </div>
</div>

<div id="slider1" class="swipe">
    <ul class="box01_list">
        <li class="li_list">
            <span style="height: 221px!important;background-color: #F3F3F3;">

                <div class="container">
                    <div id="slide" class="slide" class="index-slide" alt="star">
                        <!-- 轮播图片数量可自行增减 -->
                        <div class="img"><img src="/img/01.jpg"/></div>
                        <div class="img"><img src="/img/02.jpg"/></div>
                        <div class="img"><img src="/img/03.jpg"/></div>
                        <div class="img"><img src="/img/04.jpg"/></div>
                        <div class="img"><img src="/img/05.jpg"/></div>
                        <div class="slide-bt"></div>
                    </div>
                 </div>
             </span>
            @foreach($product_11 as $product_11)
                <a class="weui_cell" href="/product/{{$product_11->id}}">
                    <div class="weui_cell_hd"><img class="bk_preview" style="width: 60px;height: 60px;margin: 0px 6px;" src="{{$product_11->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{$product_11->name}}</span>
                        </div>
                        <p class="bk_summary">{{$product_11->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>
        <li class="li_list">
                @foreach($product_12 as $product_12)
                    <a class="weui_cell" href="/product/{{$product_12->id}}">
                        <div class="weui_cell_hd"><img class="bk_preview" style="width: 60px;height: 60px;margin: 0px 6px;" src="{{$product_12->preview}}"></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <div style="margin-bottom: 10px;">
                                <span class="bk_title">{{$product_12->name}}</span>
                            </div>
                            <p class="bk_summary">{{$product_12->summary}}</p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>
                @endforeach
            </li>
        <li class="li_list">
            @foreach($product_13 as $product_13)
                <a class="weui_cell" href="/product/{{$product_13->id}}">
                    <div class="weui_cell_hd"><img class="bk_preview" style="width: 60px;height: 60px;margin: 0px 6px;" src="{{$product_13->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{$product_13->name}}</span>
                        </div>
                        <p class="bk_summary">{{$product_13->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>
        <li class="li_list">
            @foreach($product_14 as $product_14)
                <a class="weui_cell" href="/product/{{$product_14->id}}">
                    <div class="weui_cell_hd"><img class="bk_preview" style="width: 60px;height: 60px;margin: 0px 6px;" src="{{$product_14->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{$product_14->name}}</span>
                        </div>
                        <p class="bk_summary">{{$product_14->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>
        <li class="li_list">
            @foreach($product_15 as $product_15)
                <a class="weui_cell" href="/product/{{$product_15->id}}">
                    <div class="weui_cell_hd"><img class="bk_preview" style="width: 60px;height: 60px;margin: 0px 6px;" src="{{$product_15->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{$product_15->name}}</span>
                        </div>
                        <p class="bk_summary">{{$product_15->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>
        <li class="li_list">
            @foreach($product_16 as $product_16)
                <a class="weui_cell" href="/product/{{$product_16->id}}">
                    <div class="weui_cell_hd"><img class="bk_preview" style="width: 60px;height: 60px;margin: 0px 6px;" src="{{$product_16->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{$product_16->name}}</span>
                        </div>
                        <p class="bk_summary">{{$product_16->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>
        <li class="li_list">
            @foreach($product_17 as $product_17)
                <a class="weui_cell" href="/product/{{$product_17->id}}">
                    <div class="weui_cell_hd"><img class="bk_preview" style="width: 60px;height: 60px;margin: 0px 6px;" src="{{$product_17->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{$product_17->name}}</span>
                        </div>
                        <p class="bk_summary">{{$product_17->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>

    </ul>
</div>
@endsection
@section('my-js')
<script src="/js/cangxi_news.js"></script>
    @endsection

