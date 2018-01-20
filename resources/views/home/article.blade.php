@extends('layouts.home')
@section('head')
<title>后盾个人博客</title>
<meta name="keywords" content="个人博客模板,博客模板" />
<meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
<link href="{{asset('home/views/css/new.css')}}" rel="stylesheet">
@endsection
@section('content')
<article class="blogs">
  <h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>&nbsp;&gt;&nbsp;<a href="/news/s/">慢生活</a>&nbsp;&gt;&nbsp;<a href="{{url('category/'.$article->cate_id)}}">日记</a></span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('category/'.$article->cate_id)}}" class="n2">日记</a></h1>
  <div class="index_about">
    <h2 class="c_titile">{{$article->arc_title}}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{$article->created_at}}</span><span>编辑：{{$article->arc_author}}</span><span>查看次数：{{$article->arc_click}}</span></p>
    <ul class="infos">
      {!! $article->arc_content !!}
    </ul>
    @if($tags)
    <div class="keybq">
        <p><span>关键字词</span>：{{$tags}}</p>
    </div>
    @endif
    <div class="ad"> </div>
    <div class="nextinfo">
        @if($article->pre)
            <p>上一篇：<a href="{{url('article/'.$article->pre->arc_id)}}">{{$article->pre->arc_title}}</a></p>
        @endif
        @if($article->next)
            <p>下一篇：<a href="{{url('article/'.$article->next->arc_id)}}">{{$article->next->arc_title}}</a></p>
        @endif
    </div>
    @if($relateArc->all())
        <div class="otherlink">
          <h2>相关文章</h2>
          <ul>
            @foreach($relateArc as $relate)
            <li><a href="{{url('article/'. $relate->arc_id)}}" title="{{$relate->arc_title}}">{{$relate->arc_title}}</a></li>
            @endforeach
          </ul>
        </div>
    @endif
  </div>
  @parent
</article>
@endsection