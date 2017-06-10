@extends('master')

@section('title', '关于广元')

@section('content')

<link rel="stylesheet" href="./css/cangxi_new.css">
<div class="find_nav">
    <div class="find_nav_left">
        <div class="find_nav_list">
            <ul id="pagenavi1">
               @foreach($about_name as $v)
                    <li><a href="#">{{ $v->name }}</a></li>
                   @endforeach
                <li class="sideline" ></li>
            </ul>
        </div>
    </div>
</div>

<div id="slider1" class="swipe">
    <ul class="box01_list">

        <li class="li_list" >
            @foreach($product_21 as $product_21)
                <a class="weui_cell" href="{{URl('product/'.$product_21->id)}}}">
                    <div class="weui_cell_hd"><img class="bk_preview" src="{{URL('/').$product_21->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{$product_21->name}}</span>
                        </div>
                        <p class="bk_summary">{{$product_21->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>
        <li class="li_list">
            @foreach($product_22 as $product_22)
                <a class="weui_cell" href="{{URl('product/'.$product_22->id)}}">
                    <div class="weui_cell_hd"><img class="bk_preview" src="{{URL('/'). $product_22->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{ $product_22->name}}</span>
                        </div>
                        <p class="bk_summary">{{ $product_22->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>
        <li class="li_list">
            @foreach($product_23 as $product_23)
                <a class="weui_cell" href="{{URl('product/'.$product_23->id)}}">
                    <div class="weui_cell_hd"><img class="bk_preview" src="{{URL('/').$product_23->preview}}"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="margin-bottom: 10px;">
                            <span class="bk_title">{{$product_23->name}}</span>
                        </div>
                        <p class="bk_summary">{{$product_23->summary}}</p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
            @endforeach
        </li>

    </ul>

</div>

@endsection

@section('my-js')
<script src="./js/cangxi_news.js"></script>
    @endsection

