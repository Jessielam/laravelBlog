@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 文章列表
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="" method="post">
        <table class="search_tab">
            <tr>
                <th width="120">选择分类:</th>
                <td>
                    <select onchange="javascript:location.href=this.value;">
                        <option value="">全部</option>
                        <option value="http://www.baidu.com">百度</option>
                        <option value="http://www.sina.com">新浪</option>
                    </select>
                </td>
                <th width="70">关键字:</th>
                <td><input type="text" name="keywords" placeholder="关键字"></td>
                <td><input type="submit" name="sub" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>标题</th>
                    <th>发布人</th>
                    <th>浏览次数</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                @foreach($articles as $article)
                <tr>
                    <td class="tc">{{$article->arc_id}}</td>
                    <td>
                        <a href="#">{{$article->arc_title}}</a>
                    </td>
                    <td>{{$article->arc_author}}</td>
                    <td>{{$article->arc_click}}</td>
                    <td>{{$article->updated_at}}</td>
                    <td>
                        <a href="{{url('admin/article/' . $article->arc_id . '/edit')}}">修改</a>
                        <a href="javascript:void(0);" onclick="delArticle(this, {{$article->arc_id}});">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="page_list">
               {{$articles->links()}}
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<style>
    .result_content ul li span {
        font-size: 15px;
        padding: 6px 12px;
    }
</style>

<script>
    function delArticle(obj, arc_id) {
        layer.confirm('您确定要删除该文章吗？', {
                btn: ['确定', '取消']
            }, function() {
                $.post("{{url('admin/article')}}/" + arc_id, {'_token':'{{csrf_token()}}', '_method':'delete'}, function(data) {
                    if (data.status==0) {
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                })
            }, function() {

            });
    }
</script>
@endsection