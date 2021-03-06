@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/link')}}">友链列表</a> &raquo; 友链管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑友情链接</h3>
            @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/link')}}"><i class="fa fa-list-ul"></i>友链列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/link/'. $link->link_id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>友链名称：</th>
                        <td>
                            <input type="text" name="link_name" value="{{$link->link_name}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>友链名称必须填写</span>
                        </td>
                    </tr>
                     <tr>
                        <th><i class="require">*</i>URL：</th>
                        <td>
                            <input type="text" class="lg" name="link_url" value="{{$link->link_url}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>友链标题：</th>
                        <td>
                            <input type="text" class="lg" name="link_title" value="{{$link->link_title}}">
                        </td>
                    </tr>
                    <tr>
                        <th>友链排序：</th>
                        <td>
                            <input type="text" class="sm" name="link_sort" value="{{$link->link_sort}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>ASC排序</span>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection