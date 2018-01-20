@extends('layouts.home')
@section('head')
<title>后盾个人博客</title>
<meta name="keywords" content="个人博客模板,博客模板" />
<meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />.
<link href="{{asset('home/views/css/style.css')}}" rel="stylesheet">
<link href="{{asset('home/views/css/index.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="#"><span>后盾</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>个人博客</span>模板 Templates</p>
    </h3>
    <ul>
      <li><a href="/"  target="_blank"><img src="{{asset('home/views/images/01.jpg')}}"></a><span>仿新浪博客风格·梅——古典个人博客模板</span></li>
      <li><a href="/" target="_blank"><img src="{{asset('home/views/images/02.jpg')}}"></a><span>黑色质感时间轴html5个人博客模板</span></li>
      <li><a href="/"  target="_blank"><img src="{{asset('home/views/images/03.jpg')}}"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>
      <li><a href="/" target="_blank"><img src="{{asset('home/views/images/04.jpg')}}"></a><span>女生清新个人博客网站模板</span></li>
      <li><a href="/"  target="_blank"><img src="{{asset('home/views/images/02.jpg')}}"></a><span>黑色质感时间轴html5个人博客模板</span></li>
      <li><a href="/"  target="_blank"><img src="{{asset('home/views/images/03.jpg')}}"></a><span>Green绿色小清新的夏天-个人博客模板</span></li>
    </ul>
  </div>
</div>
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
    @foreach($articles as $article)
    <h3><a href="{{url('article/'. $article->arc_id)}}">{{$article->arc_title}}</a></h3>
    <figure><img src="{{asset($article->arc_thumb)}}"></figure>
    <ul>
      <p>{{$article->arc_digest}}</p>
      <a title="{{$article->arc_title}}" href="{{url('article/'. $article->arc_id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span>{{$article->created_at}}</span><span>作者：{{$article->arc_author}}</span><span>个人博客：[<a href="/news/life/">程序人生</a>]</span></p>
    @endforeach

    <!-- <div class="page">
      <ul class="pagination">
        <li class="disabled"><span>«</span></li>
        <li class="active"><span>1</span></li>
        <li><a href="http://blog.hd/admin/article?page=2">2</a></li>
        <li><a href="http://blog.hd/admin/article?page=2" rel="next">»</a></li>
      </ul>
    </div> -->
    <div class="page">
      {{$articles->links()}} 
    </div>
  </div>
  @parent
</article>
@endsection
