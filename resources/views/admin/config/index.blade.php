@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置列表
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>网站配置管理</h3>
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
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加系统配置</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-refresh"></i>更新系统配置</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <form method="post" action="{{url('admin/config/saveContent')}}">
            {{csrf_field()}}
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="10%">排序</th>
                        <th class="tc" width="10%">ID</th>
                        <th>配置名称</th>
                        <th>配置标题</th>
                        <th width="40%">配置内容</th>
                        <th>操作</th>
                    </tr>
                    @foreach($configs as $config)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeSort(this, {{$config->conf_id}})" value="{{$config->sort}}" style="width:50%">
                        </td>
                        <td class="tc">{{$config->conf_id}}</td>
                        <td>
                            <a href="{{url('admin/config/'.$config->conf_id.'/edit')}}">{{$config->conf_name}}</a>
                        </td>
                        <td>{{$config->conf_title}}</td>
                        <td>{!! $config->_html !!}</td> 
                        <td>
                            <a href="{{url('admin/config/'.$config->conf_id.'/edit')}}">修改</a>
                            <a href="javascript:void(0);" onclick="delconfig(this, {{$config->conf_id}});">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="btn_group">
                <input type="submit" value="提交">
                <input type="button" class="back" onclick="history.go(-1)" value="返回" >
            </div>
        </form>
    </div>
    <!--搜索结果页面 列表 结束-->

    <script>
        //删除分类
        function delconfig(obj, conf_id) {
            layer.confirm('您确定要删除该系统配置吗？', {
                btn: ['确定', '取消']
            }, function() {
                $.post("{{url('admin/config')}}/" + conf_id, {'_token':'{{csrf_token()}}', '_method':'delete'}, function(data) {
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
        function changeSort(obj, configId) {
            var conf_sort = $(obj).val();
            $.post("{{url('admin/config/sort')}}", {'_token': '{{csrf_token()}}', 'conf_id': configId, 'conf_sort': conf_sort}, function(data) {
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