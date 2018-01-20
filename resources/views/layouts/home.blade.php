<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="{{Config::get('systemconfig.web_icon')}}" />
	<link href="{{asset('home/views/css/base.css')}}" rel="stylesheet">
	@yield('head')
	<!--[if lt IE 9]>
	<script src="{{asset('home/views/js/modernizr.js')}}"></script>
	<![endif]-->
</head>
<body>
	<header>
		<div id="logo"><a href="/"></a></div>
		<nav class="topnav" id="topnav">
			@foreach($navs as $nav)<a href="{{$nav->nav_url}}"><span>{{$nav->nav_name}}</span><span class="en">{{$nav->nav_alias}}</span></a>@endforeach
		</nav>
	</header>
	@section('content')
		<aside class="right">
		@if(isset($subCates))
			@if($subCates->all())
			<div class="rnav">
				<ul>
				@foreach($subCates as $k=>$subCate)
					<li class="rnav{{$k+1}}"><a href="{{url('category/'.$subCate->cate_id)}}" target="_blank">{{$subCate->cate_name}}</a></li>
				@endforeach
				</ul>      
			</div>
			@endif
		@endif
    <div class="news" style="margin-bottom: 60px;">
        <h3><p>博文分享</p></h3>
        <!-- Baidu Button BEGIN -->
        <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
        <script type="text/javascript" id="bdshell_js"></script> 
        <script type="text/javascript">
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script> 
        <!-- Baidu Button END --> 
    </div>
  <div class="news" style="float: left;">
      <h3>
        <p>点击<span>排行</span></p>
      </h3>
      <ul class="paih">
        @foreach($clickMosts as $clickMost)
        <li><a href="{{url('article/'.$clickMost->arc_id)}}" title="{{$clickMost->arc_title}}" target="_blank">{{$clickMost->arc_title}}</a></li>
        @endforeach
      </ul>
      <h3 class="ph">
        <p>推荐<span>文章</span></p>
      </h3>
      <ul class="rank">
        @foreach($recomends as $recomend)
        <li><a href="{{url('article/'.$recomend->arc_id)}}" title="{{$recomend->arc_title}}" target="_blank">{{$recomend->arc_title}}</a></li>
        @endforeach
      </ul>
     <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
      @foreach($links as $link)
      <li><a href="{{$link->link_url}}" target="_blank">{{$link->link_name}}</a></li>
      @endforeach
    </ul>
      <h3 class="">
        <p>天气<span>信息</span></p>
      </h3> 
       <iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe>
    </div>
  </div>

</aside>
	@show
	<footer>
		<p>Design by 后盾网 <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.houdunwang.com</a> <a href="/">网站统计</a></p>
	</footer>
	<!-- <script src="{{asset('home/views/js/silder.js')}}"></script> -->
</body>
</html>