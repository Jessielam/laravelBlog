@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 标签列表
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="" method="post">
        <table class="search_tab">
            <tr>
                <!-- <th width="120">选择分类:</th>
                <td>
                    <select onchange="javascript:location.href=this.value;">
                        <option value="">全部</option>
                        <option value="http://www.baidu.com">百度</option>
                        <option value="http://www.sina.com">新浪</option>
                    </select>
                </td> -->
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
                <a href="{{url('admin/tag/create')}}"><i class="fa fa-plus"></i>添加标签</a>
                <a href="{{url('admim/tag')}}"><i class="fa fa-refresh"></i>页面刷新</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="10%">ID</th>
                    <th width="40%">标签名称</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                @foreach($tagData as $tag)
                <tr>
                    <td class="tc">{{$tag->tag_id}}</td>
                    <td>
                        <a href="{{url('admin/tag/'.$tag->tag_id.'/edit')}}">{{$tag->tag_name}}</a>
                    </td>
                    <td>{{date('Y-m-d H:i:s', $tag->created_at)}}</td>
                    <td>
                        <a href="{{url('admin/tag/'.$tag->tag_id.'/edit')}}">修改</a>
                        <a href="javascript: void(0);" onclick="delTag(this, {{$tag->tag_id}});">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
            <!-- {{$tagData->links()}} -->
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
<script>
    function delTag(obj, tag_id)
    {
        layer.confirm('您确定要删除该标签吗？', {
            btn: ['确定', '取消']
        }, function() {
            $.post("{{url('admin/tag')}}/" + tag_id, {'_token':'{{csrf_token()}}', '_method':'delete'}, function(data) {
                if (data.status==0) {
                    $(obj).parent().parent().remove();
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