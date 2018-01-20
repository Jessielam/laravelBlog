@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 友链列表
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<!-- <div class="search_wrap">
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
    </div> -->
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>友链管理</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/link/create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                    <a href="{{url('admin/link')}}"><i class="fa fa-refresh"></i>更新友情链接</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="10%">排序</th>
                        <th class="tc" width="10%">ID</th>
                        <th>友链名称</th>
                        <th>友链标题</th>
                        <th width="40%">友链地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($links as $link)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeSort(this, {{$link->link_id}})" value="{{$link->link_sort}}" style="width:50%">
                        </td>
                        <td class="tc">{{$link->link_id}}</td>
                        <td>
                            <a href="{{url('admin/link/'.$link->link_id.'/edit')}}">{{$link->link_name}}</a>
                        </td>
                        <td>{{$link->link_title}}</td>
                        <td>{{$link->link_url}}</td> 
                        <td>
                            <a href="{{url('admin/link/'.$link->link_id.'/edit')}}">修改</a>
                            <a href="javascript:void(0);" onclick="delLink(this, {{$link->link_id}});">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

    <script>
        //删除分类
        function delLink(obj, link_id) {
            layer.confirm('您确定要删除该友情链接吗？', {
                btn: ['确定', '取消']
            }, function() {
                $.post("{{url('admin/link')}}/" + link_id, {'_token':'{{csrf_token()}}', '_method':'delete'}, function(data) {
                    if (data.status==1) {
                        $(obj).parent().parent().remove();
                        layer.msg(data.msg, {icon: 6});
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                })
            }, function() {

            });
        }

        //修改排序
        function changeSort(obj, linkId) {
            var link_sort = $(obj).val();
            $.post("{{url('admin/link/sort')}}", {'_token': '{{csrf_token()}}', 'link_id': linkId, 'link_sort': link_sort}, function(data) {
                if (data.status==0) {
                    layer.msg(data.msg, {icon: 6});
                    //location.href = location.href;
                } else {
                    layer.msg(data.msg, {icon: 5});
                }
            });
        }
    </script>
@endsection