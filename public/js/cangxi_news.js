/**
 * Created by Administrator on 2017/4/6.
 */
/**
 * Created by Administrator on 2017/3/11.
 */
/*
 * TouchSlider v1.0.5
 * By qiqiboy, http://www.qiqiboy.com, http://weibo.com/qiqiboy, 2012/04/11
 */
(function(window, undefined){
    var ADSupportsTouches = ("createTouch" in document) || ('ontouchstart' in window) || 0,
        doc=document.documentElement || document.getElementsByTagName('html')[0],
        ADSupportsTransition = ("WebkitTransition" in doc.style)
            || ("MsTransition" in doc.style)
            || ("MozTransition" in doc.style)
            || ("OTransition" in doc.style)
            || ("transition" in doc.style)
            || 0,
        ADStartEvent = ADSupportsTouches ? "touchstart" : "mousedown",
        ADMoveEvent = ADSupportsTouches ? "touchmove" : "mousemove",
        ADEndEvent = ADSupportsTouches ? "touchend" : "mouseup",
        TouchSlider=function(opt){
            this.opt=this.parse_args(opt);
            this.container=this.$(this.opt.id);
            try{
                if(this.container.nodeName.toLowerCase()=='ul'){
                    this.element=this.container;
                    this.container=this.element.parentNode;
                }else{
                    this.element=this.container.getElementsByTagName('ul')[0];
                }
                if(typeof this.element==='undefined')throw new Error('Can\'t find "ul"');
                for(var i=0;i<this.instance.length;i++){
                    if(this.instance[i]==this.container) throw new Error('An instance is running');
                }
                this.instance.push(this.container);
                this.setup();
            }catch(e){
                this.status=-1;
                this.errorInfo=e.message;
            }
        }

    TouchSlider.prototype={
        //默认配置
        _default: {
            'id': 'slider', //幻灯容器的id
            'fx': 'ease-out', //css3动画效果（linear,ease,ease-out,ease-in,ease-in-out），不支持css3浏览器只有ease-out效果
            'auto': 0, //是否自动开始，负数表示非自动开始，0,1,2,3....表示自动开始以及从第几个开始
            'speed':600, //动画效果持续时间 ms
            'timeout':5000,//幻灯间隔时间 ms
            'className':'', //每个幻灯所在的li标签的classname,
            'direction':'left', //left right up down
            'mouseWheel':false,
            'before':new Function(),
            'after':new Function()
        },
        instance:[],
        //根据id获取节点
        $:function(id){
            return document.getElementById(id);
        },
        //根据class、标签获取parent下的节点簇 getElementsByClass
        $E:function(classname, tagname, parent){
            var result=[],
                _array=parent.getElementsByTagName(tagname);
            for(var i=0,j=_array.length;i<j;i++){
                if((new RegExp("(?:^|\\s+)"+classname+"(?:\\s+|$)")).test(_array[i].className)){
                    result.push(_array[i]);
                }
            }
            return result;
        },
        isIE:function(){ //不包括IE9+，IE9开始支持W3C绝大部分事件 方法了
            return !-[1,];
        },
        //设置OR获取节点样式
        css:(function(){
            var styleFilter=function(property){
                    switch(property){
                        case 'float' : return ("cssFloat" in document.body.style) ? 'cssFloat' : 'styleFloat';
                            break;
                        case 'opacity' : return ("opacity" in document.body.style) ? 'opacity' :
                            {
                                get : function(el,style){
                                    var ft=style.filter;
                                    return ft&&ft.indexOf('opacity')>=0&&parseFloat(ft.match(/opacity=([^)]*)/i)[1])/100+''||'1';
                                },
                                set : function(el,va){
                                    el.style.filter='alpha(opacity='+va*100+')';
                                    el.style.zoom=1;
                                }
                            } ;
                            break;
                        default:var arr=property.split('-');
                            for(var i = 1; i < arr.length; i++)
                                arr[i] = arr[i].substring(0,1).toUpperCase() + arr[i].substring(1);
                            property = arr.join('');
                            return property;
                            break;
                    }
                },
                getStyle=function(el,property){
                    property=styleFilter(property);
                    var value = el.style[property];
                    if (!value) {
                        var style = document.defaultView && document.defaultView.getComputedStyle && getComputedStyle(el, null) || el.currentStyle || el.style;
                        if(typeof property=='string'){
                            value=style[property];
                        }else value=property.get(el,style);
                    }
                    return value == 'auto' ? '' : value;
                },
                setStyle=function(el,css){
                    var attr;
                    for(var key in css){
                        attr=styleFilter(key);
                        if(typeof attr=='string'){
                            el.style[attr]=css[key];
                        }else{
                            attr.set(el,css[key]);
                        }
                    }
                }
            return function(el,css){
                return typeof css=='string'?getStyle(el,css):setStyle(el,css);
            }
        })(),
        //格式化参数
        parse_args: function(r){
            var _default={}, toString=Object.prototype.toString;
            if(r && toString.call(r)=='[object Object]')
                for(var key in this._default){
                    _default[key]=typeof r[key]==='undefined' ? this._default[key] : toString.call(this._default[key])=='[object Number]' ? parseInt(parseFloat(r[key])*100)/100 : r[key];
                }
            else _default=this._default;
            return _default;
        },
        //绑定事件
        addListener: function(e, n, o, u){
            if(e.addEventListener){
                e.addEventListener(n, o, u);
                return true;
            } else if(e.attachEvent){
                e.attachEvent('on' + n, o);
                return true;
            }
            return false;
        },
        //获取鼠标坐标
        getMousePoint:function(ev) {
            var x = 0
            var y = 0,
                doc = document.documentElement,
                body = document.body;
            if(!ev) ev=window.event;
            if (window.pageYoffset) {
                x = window.pageXOffset;
                y = window.pageYOffset;
            }else{
                x = (doc && doc.scrollLeft || body && body.scrollLeft || 0) - (doc && doc.clientLeft || body && body.clientLeft || 0);
                y = (doc && doc.scrollTop  || body && body.scrollTop  || 0) - (doc && doc.clientTop  || body && body.clientTop  || 0);
            }
            if(ADSupportsTouches && ev.touches.length){
                var evt = ev.touches[0];
                x += evt.clientX;
                y += evt.clientY;
            }else{
                x += ev.clientX;
                y += ev.clientY;
            }
            return {'x' : x, 'y' : y};
        },
        //修正函数作用环境
        bind:function(func, obj){
            return function(){
                return func.apply(obj, arguments);
            }
        },
        preventDefault:function(e){
            if(window.event)window.event.returnValue=false;
            else e.preventDefault();
        },
        //初始化
        setup: function(){
            this.status=0;//状态码，0表示停止状态，1表示运行状态，2表示暂停状态，-1表示出错
            this.slides=this.opt.className?this.$E(this.opt.className,'li',this.element):this.element.getElementsByTagName('li');
            this.length=this.slides.length; this.opt.timeout=Math.max(this.opt.timeout,this.opt.speed);
            this.touching=!!ADSupportsTouches; this.css3transition=!!ADSupportsTransition;
            this.index=this.opt.auto<0 || this.opt.auto>=this.length ? 0:this.opt.auto;
            if(this.length<2)return;//小于2不需要滚动
            switch(this.opt.direction){
                case 'up': this.direction='up'; this.vertical=true; break;
                case 'down': this.direction='down'; this.vertical=true; break;
                case 'right': this.direction='right'; this.vertical=false; break;
                default:this.direction='left'; this.vertical=false; break;
            }
            this.resize(); this.begin();

            this.addListener(this.element,ADStartEvent,this.bind(this._start,this),false);
            this.addListener(document,ADMoveEvent,this.bind(this._move,this),false);
            this.addListener(document,ADEndEvent,this.bind(this._end,this),false);
            this.addListener(this.element,'webkitTransitionEnd',this.bind(this._transitionend,this),false);
            this.addListener(this.element,'msTransitionEnd',this.bind(this._transitionend,this),false);
            this.addListener(this.element,'oTransitionEnd',this.bind(this._transitionend,this),false);
            this.addListener(this.element,'transitionend',this.bind(this._transitionend,this),false);
            this.addListener(window,'resize',this.bind(function(){
                clearTimeout(this.resizeTimer);
                this.resizeTimer=setTimeout(this.bind(this.resize,this),100);
            },this),false);
            this.addListener(this.element,'mousewheel',this.bind(this.mouseScroll,this),false);
            this.addListener(this.element,'DOMMouseScroll',this.bind(this.mouseScroll,this),false);
        },
        resize:function(){
            var css;
            this.css(this.container,{'overflow':'hidden','visibility':'hidden','listStyle':'none','position':'relative'});
            this.width=this.container.clientWidth-parseInt(this.css(this.container,'padding-left'))-parseInt(this.css(this.container,'padding-right'));
            this.height=this.container.clientHeight-parseInt(this.css(this.container,'padding-top'))-parseInt(this.css(this.container,'padding-bottom'));
            css={'position':'relative','webkitTransitionDuration':'0ms','MozTransitionDuration':'0ms','msTransitionDuration':'0ms','OTransitionDuration':'0ms','transitionDuration':'0ms'}
            if(this.vertical){
                css['height']=this.height*this.length+'px';
                css['top']=-this.height*this.index+'px';
                this.css(this.container,{'height':this.height+'px'});
            }else{
                css['width']=this.width*this.length+'px';
                css['left']=-this.width*this.index+'px';
            }
            this.css(this.element,css);
            for(var i=0;i<this.length;i++){
                this.css(this.slides[i],{'width':this.width+'px','display':this.vertical?'table-row':'table-cell',padding:0,margin:0,float:'left',verticalAlign:'top'});
            }
            this.css(this.container,{'visibility':'visible'});
        },
        slide:function(index, speed){
            var direction=this.vertical?'top':'left', size=this.vertical?'height':'width';
            index=index<0?this.length-1:index>=this.length?0:index;
            speed=typeof speed == 'undefined' ? this.opt.speed : parseInt(speed);
            var el=this.element, timer=null,
                style=el.style,
                _this=this,
                t=0, //动画开始时间
                b=parseInt(style[direction]) || 0, //初始量
                c=-index*this[size]-b, //变化量
                d=Math.abs(c)<this[size]?Math.ceil(Math.abs(c)/this[size]*speed/10):speed/10,//动画持续时间
                ani=function(t,b,c,d){ //缓动效果计算公式
                    return -c * ((t=t/d-1)*t*t*t - 1) + b;
                },
                run=function(){
                    if(t<d && !ADSupportsTransition){
                        t++;
                        style[direction]=Math.ceil(ani(t,b,c,d))+'px';
                        timer=setTimeout(run, 10);
                    }else{
                        style[direction]=-_this[size]*index+'px';
                        _this.index=index;
                        if(!ADSupportsTransition)_this._transitionend();
                        _this.pause();_this.begin();
                    }
                }
            style.WebkitTransition=style.MozTransition=style.msTransition=style.OTransition=style.transition = direction+' '+(d*10)+'ms '+this.opt.fx;
            this.opt.before.call(this, index, this.slides[this.index]); run();
        },
        begin:function(){
            if(this.timer || this.opt.auto<0)return true;
            this.timer=setTimeout(this.bind(function(){
                this.direction=='left'||this.direction=='up' ? this.next() : this.prev();
            },this), this.opt.timeout);
            this.status=1;
        },
        pause:function(){
            clearInterval(this.timer);
            this.timer=null;
            this.status=2;
        },
        stop:function(){
            this.pause();
            this.index=0;
            this.slide(0);
            this.status=0;
        },
        prev:function(offset){
            offset=typeof offset == 'undefined'?offset=1:offset%this.length;
            var index=offset>this.index?this.length+this.index-offset:this.index-offset;
            this.slide(index);
        },
        next:function(offset){
            if(typeof offset == 'undefined') offset=1;
            this.slide((this.index+offset)%this.length);
        },
        _start:function(e){
            if(!this.touching)this.preventDefault(e);
            this.element.onclick=null
            this.startPos=this.getMousePoint(e);
            var style=this.element.style;
            style.webkitTransitionDuration = style.MozTransitionDuration = style.msTransitionDuration = style.OTransitionDuration = style.transitionDuration = '0ms';
            this.scrolling=1;//滚动屏幕
            this.startTime=new Date();
        },
        _move:function(e){
            if(!this.scrolling || e.touches && e.touches.length>1 || e.scale && e.scale !== 1) return;
            var direction=this.vertical?'top':'left', size=this.vertical?'height':'width', xy=this.vertical?'y':'x', yx=this.vertical?'x':'y';
            this.endPos=this.getMousePoint(e);
            var offx=this.endPos[xy]-this.startPos[xy];
            if(this.scrolling===2 || Math.abs(offx)>=Math.abs(this.endPos[yx]-this.startPos[yx])){
                this.preventDefault(e);
                this.pause(); //暂停幻灯
                offx=offx/((!this.index&&offx>0 || this.index==this.length-1&&offx<0) ? (Math.abs(offx)/this[size]+1) : 1);
                this.element.style[direction]=-this.index*this[size]+offx+'px';
                if(offx!=0)this.scrolling=2;//标记拖动（有效触摸）2
            }else this.scrolling=0;//设置为摒弃标记0
        },
        _end:function(e){
            if(typeof this.scrolling != 'undefined'){
                try{
                    var xy=this.vertical?'y':'x', size=this.vertical?'height':'width', offx=this.endPos[xy]-this.startPos[xy];
                    if(this.scrolling===2)this.element.onclick=new Function('return false;');
                }catch(err){
                    offx=0;
                }
                if((new Date()-this.startTime<250 && Math.abs(offx)>this[size]*0.1 || Math.abs(offx)>this[size]/2) && ((offx<0 && this.index+1<this.length) || (offx>0 && this.index>0))){
                    offx>0?this.prev():this.next();
                }else{
                    this.slide(this.index);
                }
                delete this.scrolling;//删掉标记
                delete this.startPos;
                delete this.endPos;
                delete this.startTime;
                if(this.opt.auto>=0)this.begin();
            }
        },
        mouseScroll:function(e){
            if(this.opt.mouseWheel){
                this.preventDefault(e);
                e=e||window.event;
                var wheelDelta=e.wheelDelta || e.detail && e.detail*-1 || 0,
                    flag=wheelDelta/Math.abs(wheelDelta);//这里flag指鼠标滚轮的方向，1表示向上，-1向下
                wheelDelta>0?this.next():this.prev();
            }
        },
        _transitionend:function(e){
            this.opt.after.call(this, this.index, this.slides[this.index]);
        }
    }
    window.TouchSlider=TouchSlider;
})(window, undefined);



// 给li定义高度，配合css使li独立滚动
var $window = $(window);
var initialWindowHeight = null;

$window.resize(function() {
    sliderHeight();
});

sliderHeight();
function sliderHeight(){
    var wHeight = $(window).height();
    var sliderHeight = wHeight - 70

    $(".swipe li").height(sliderHeight);
}


$(".find_nav_list").css("left",20);/*制作屏幕兼容居中，顶部通栏的初始位置*/

$(".find_nav_list li").each(function(){
    $(".sideline").css({left:0});
    $(".find_nav_list li").eq(0).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
});
var nav_w=$(".find_nav_list li").first().width();
$(".sideline").width(nav_w);
$(".find_nav_list li").on('click', function(){
    nav_w=$(this).width();
    $(".sideline").stop(true);
    $(".sideline").animate({left:$(this).position().left},300);
    $(".sideline").animate({width:nav_w});
    $(this).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
    var fn_w = ($(".find_nav").width() - nav_w) / 2;
    var fnl_l;
    var fnl_x = parseInt($(this).position().left);
    if (fnl_x <= fn_w) {
        fnl_l = 0;
    } else if (fn_w - fnl_x <= flb_w - fl_w) {
        fnl_l = flb_w - fl_w;
    } else {
        fnl_l = fn_w - fnl_x;
    }
    $(".find_nav_list").animate({
        "left" : fnl_l
    }, 300);

});
var fl_w=$(".find_nav_list").width();
var flb_w=$(".find_nav_left").width();
$(".find_nav_list").on('touchstart', function (e) {
    var touch1 = e.originalEvent.targetTouches[0];
    x1 = touch1.pageX;
    y1 = touch1.pageY;
    ty_left = parseInt($(this).css("left"));
});
$(".find_nav_list").on('touchmove', function (e) {
    var touch2 = e.originalEvent.targetTouches[0];
    var x2 = touch2.pageX;
    var y2 = touch2.pageY;
    if(ty_left + x2 - x1>=0){
        $(this).css("left", 0);
    }else if(ty_left + x2 - x1<=flb_w-fl_w){
        $(this).css("left", flb_w-fl_w);
    }else{
        $(this).css("left", ty_left + x2 - x1);
    }
    if(Math.abs(y2-y1)>0){
        e.preventDefault();
    }
});


for(n=1;n<9;n++){
    var page='pagenavi'+n;
    var mslide='slider'+n;
    var mtitle='emtitle'+n;
    arrdiv = 'arrdiv' + n;
    var as=$("#" + page + "").find("a");
    var tt=new TouchSlider({id:mslide,'auto':'-1',fx:'ease-out',direction:'left',speed:600,timeout:5000,'before':function(index){
        var as=document.getElementById(this.page).getElementsByTagName('a');
        as[this.p].className='';
        this.p=index;

        fnl_x =  parseInt($(".find_nav_list li").eq(this.p).position().left);

        nav_w=$(".find_nav_list li").eq(this.p).width();
        $(".sideline").stop(true);
        $(".sideline").animate({left:$(".find_nav_list li").eq(this.p).position().left},300);
        $(".sideline").animate({width:nav_w},100);
        $(".find_nav_list li").eq(this.p).addClass("find_nav_cur").siblings().removeClass("find_nav_cur");
        var fn_w = ($(".find_nav").width() - nav_w) / 2;
        var fnl_l;
        if (fnl_x <= fn_w) {
            fnl_l = 20;/*从右方往左方滑动，第一块的初始位置*/
        } else if (fn_w - fnl_x <= flb_w - fl_w) {
            fnl_l = flb_w - fl_w;
        } else {
            fnl_l = fn_w - fnl_x;
        }
        $(".find_nav_list").animate({
            "left" : fnl_l
        }, 300);
    }});
    tt.page = page;
    tt.p = 0;
    //console.dir(tt); console.dir(tt.__proto__);

    for(var i=0;i<as.length;i++){
        (function(){
            var j=i;
            as[j].tt = tt;
            as[j].onclick=function(){
                this.tt.slide(j);
                return false;
            }
        })();
    }
}

/**
 * Created by Administrator on 2017/3/12.
 */
var autoLb = true;          //autoLb=true为开启自动轮播
var autoLbtime = 6;         //autoLbtime为轮播间隔时间（单位秒）
var touch = true;           //touch=true为开启触摸滑动
var slideBt = true;         //slideBt=true为开启滚动按钮
var slideNub;               //轮播图片数量

//窗口大小改变时改变轮播图宽高
$(window).resize(function(){
    $(".slide").height($(".slide").width()*0.56);
});


$(function(){
    $(".slide").height($(".slide").width()*0.56);
    slideNub = $(".slide .img").size();             //获取轮播图片数量
    for(i=0;i<slideNub;i++){
        $(".slide .img:eq("+i+")").attr("data-slide-imgId",i);
    }


    //根据轮播图片数量设定图片位置对应的class
    if(slideNub==1){
        for(i=0;i<slideNub;i++){
            $(".slide .img:eq("+i+")").addClass("img3");
        }
    }
    if(slideNub==2){
        for(i=0;i<slideNub;i++){
            $(".slide .img:eq("+i+")").addClass("img"+(i+3));
        }
    }
    if(slideNub==3){
        for(i=0;i<slideNub;i++){
            $(".slide .img:eq("+i+")").addClass("img"+(i+2));
        }
    }
    if(slideNub>3&&slideNub<6){
        for(i=0;i<slideNub;i++){
            $(".slide .img:eq("+i+")").addClass("img"+(i+1));
        }
    }
    if(slideNub>=6){
        for(i=0;i<slideNub;i++){
            if(i<5){
                $(".slide .img:eq("+i+")").addClass("img"+(i+1));
            }else{
                $(".slide .img:eq("+i+")").addClass("img5");
            }
        }
    }


    //根据轮播图片数量设定轮播图按钮数量
    if(slideBt){
        for(i=1;i<=slideNub;i++){
            $(".slide-bt").append("<span data-slide-bt='"+i+"' onclick='tz("+i+")'></span>");
        }
        $(".slide-bt").width(slideNub*34);
        $(".slide-bt").css("margin-left","-"+slideNub*17+"px");
    }


    //自动轮播
    if(autoLb){
        setInterval(function(){
            right();
        }, autoLbtime*1000);
    }


    if(touch){
        k_touch();
    }
    slideLi();
    imgClickFy();
})


//右滑动
function right(){
    var fy = new Array();
    for(i=0;i<slideNub;i++){
        fy[i]=$(".slide .img[data-slide-imgId="+i+"]").attr("class");
    }
    for(i=0;i<slideNub;i++){
        if(i==0){
            $(".slide .img[data-slide-imgId="+i+"]").attr("class",fy[slideNub-1]);
        }else{
            $(".slide .img[data-slide-imgId="+i+"]").attr("class",fy[i-1]);
        }
    }
    imgClickFy();
    slideLi();
}


//左滑动
function left(){
    var fy = new Array();
    for(i=0;i<slideNub;i++){
        fy[i]=$(".slide .img[data-slide-imgId="+i+"]").attr("class");
    }
    for(i=0;i<slideNub;i++){
        if(i==(slideNub-1)){
            $(".slide .img[data-slide-imgId="+i+"]").attr("class",fy[0]);
        }else{
            $(".slide .img[data-slide-imgId="+i+"]").attr("class",fy[i+1]);
        }
    }
    imgClickFy();
    slideLi();
}


//轮播图片左右图片点击翻页
function imgClickFy(){
    $(".slide .img").removeAttr("onclick");
    $(".slide .img2").attr("onclick","left()");
    $(".slide .img4").attr("onclick","right()");
}


//修改当前最中间图片对应按钮选中状态
function slideLi(){
    var slideList = parseInt($(".slide .img3").attr("data-slide-imgId")) + 1;
    $(".slide-bt span").removeClass("on");
    $(".slide-bt span[data-slide-bt="+slideList+"]").addClass("on");
}


//轮播按钮点击翻页
function tz(id){
    var tzcs = id - (parseInt($(".slide .img3").attr("data-slide-imgId")) + 1);
    if(tzcs>0){
        for(i=0;i<tzcs;i++){
            setTimeout(function(){
                right();
            },1);
        }
    }
    if(tzcs<0){
        tzcs=(-tzcs);
        for(i=0;i<tzcs;i++){
            setTimeout(function(){
                left();
            },1);
        }
    }
    slideLi();
}


//触摸滑动模块
function k_touch() {
    var _start = 0, _end = 0, _content = document.getElementById("slide");
    _content.addEventListener("touchstart", touchStart, false);
    _content.addEventListener("touchmove", touchMove, false);
    _content.addEventListener("touchend", touchEnd, false);
    function touchStart(event) {
        var touch = event.targetTouches[0];
        _start = touch.pageX;
    }
    function touchMove(event) {
        var touch = event.targetTouches[0];
        _end = (_start - touch.pageX);
    }

    function touchEnd(event) {
        if (_end < -20) {
            left();
            _end=0;
        }else if(_end > 20){
            right();
            _end=0;
        }
    }
}
