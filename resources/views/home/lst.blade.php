@extends('layouts.home')
@section('head')
<title>后盾个人博客</title>
<meta name="keywords" content="个人博客模板,博客模板" />
<meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
<link href="{{asset('home/views/css/style.css')}}" rel="stylesheet">
@endsection
@section('content')
<article class="blogs">
<h1 class="t_nav"><span>{{$category->cate_desc}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('category/'.$category->cate_id)}}" class="n2">{{$category->cate_name}}</a></h1>
<div class="newblog left">
    @foreach($cateArticles as $article)
   <h2><a href="{{url('article/'. $article->arc_id)}}">{{$article->arc_title}}</a></h2>
   <p class="dateview"><span>发布时间：{{$article->created_at}}</span><span>作者：{{$article->arc_author}}</span><span>分类：[<a href="{{url('category/'.$category->cate_id)}}">{{$category->cate_name}}</a>]</span></p>
    <figure><img src="{{asset($article->arc_thumb)}}"></figure>
    <ul class="nlist">
      <p>{{$article->arc_digest}}</p>
      <a title="{{$article->arc_title}}" href="{{url('article/'. $article->arc_id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <div class="line"></div>
    @endforeach
    <div class="blank"></div>
    <div class="ad">  
    <!-- <img src="{{asset('home/views/images/ad.png')}}"> -->
    </div>
    <div class="page">
      {{$cateArticles->links()}} 
    </div>
</div>
  @parent
</article>
@endsection