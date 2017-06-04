@extends('admin.master')

@section('content')
<header class="Hui-header cl"><a class="Hui-logo l" title="广元发布" href="/admin/index">政府信息发布系统</a><span class="Hui-subtitle l">后台</span>
	<ul class="Hui-userbar">

		<li><a href="/admin/exit">退出</a></li>
		<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
	</ul>
	<a href="javascript:;" class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a>
</header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe616;</i> 新闻资讯<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/category" data-title="分类管理" href="javascript:void(0)"><i class="Hui-iconfont">&#xe681;</i> 分类列表</a></li>
					<li><a _href="/admin/product" data-title="内容管理" href="javascript:void(0)"><i class="Hui-iconfont">&#xe63c;</i> 内容管理</a></li>
					<li><a _href="/cangxi_news" data-title="信息预览" href="javascript:void(0)"><i class="Hui-iconfont">&#xe695;</i> 信息预览</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 概况一览<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/admin/gk" data-title="概况编辑" href="javascript:void(0)"><i class="Hui-iconfont">&#xe63c;</i> 概况编辑</a></li>
					<li><a _href="/about_gy" data-title="概况预览" href="javascript:;"><i class="Hui-iconfont">&#xe695;</i> 概况预览</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-fengcai">
			<dt><i class="Hui-iconfont">&#xe613;</i> 风采图集<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="http://tcf.natapp1.cc/elite/index.php/Home/Shouye/show" data-title="风采管理" href="javascript:;"><i class="Hui-iconfont">&#xe63c;</i> 风采管理</a></li>
					<li><a _href="http://tcf.natapp1.cc/elite/index.php/Home/Shouye/pc_lst" data-title="风采预览" href="javascript:;"><i class="Hui-iconfont">&#xe695;</i> 风采预览</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe667;</i> 最新活动<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="http://tcf.natapp1.cc/elite/index.php/Home/Hdadd/lst" data-title="活动编辑" href="javascript:;"><i class="Hui-iconfont">&#xe63c;</i> 活动编辑</a></li>
					<li><a _href="http://tcf.natapp1.cc/elite/index.php/Home/Hdbm/lst" data-title="报名列表" href="javascript:;"><i class="Hui-iconfont">&#xe681;</i> 报名列表</a></li>
					<li><a _href="http://tcf.natapp1.cc/elite/index.php/Home/Hdadd/show" data-title="活动预览" href="javascript:;"><i class="Hui-iconfont">&#xe695;</i> 活动预览</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60c;</i> 信息反馈<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="http://tcf.natapp1.cc/elite/index.php/Home/Companyinfo/lst" data-title="信息编辑" href="javascript:;"><i class="Hui-iconfont">&#xe63c;</i> 信息编辑</a></li>
					<li><a _href="http://tcf.natapp1.cc/elite/index.php/Home/Userinfo/lst" data-title="留言情况" href="javascript:;"><i class="Hui-iconfont">&#xe687;</i> 留言情况</a></li>
					<li><a _href="http://tcf.natapp1.cc/elite/index.php/Home/Companyinfo/show" data-title="反馈预览" href="javascript:;"><i class="Hui-iconfont">&#xe695;</i> 反馈预览</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</aside>
<div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="首页" data-href="welcome">首页</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="/welcome"></iframe>
		</div>
	</div>
</section>
@endsection
