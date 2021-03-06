@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/config')}}">配置项列表</a> &raquo; 配置管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>添加配置</h3>
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
                <a href="{{url('admin/config')}}"><i class="fa fa-list-ul"></i>配置列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/config')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>配置标题：</th>
                        <td>
                            <input type="text" name="conf_title" />
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置标题必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>配置名称：</th>
                        <td>
                            <input type="text" name="conf_name">
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置名称必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th>显示排序：</th>
                        <td>
                            <input type="text" class="sm" name="sort" value="0">
                            <span><i class="fa fa-exclamation-circle yellow"></i>ASC排序</span>
                        </td>
                    </tr>
                     <tr id="field_type">
                        <th><i class="require">*</i>输入类型：</th>
                        <td>
                            <select class="inc_type" name="inc_type">
                                <option value=""> -- 请选择输入类型 -- </option> 
                                <option value="text">text</option>
                                <option value="textarea">textarea</option>
                                <option value="radio">radio</option>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <th><i class="require">*</i>备注：</th>
                        <td>
                            <textarea name="conf_tips"></textarea>
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
        <script>
            $(".inc_type").change(function(){
                var type=$(this).children('option:selected').val(); //这就是selected的值
                if (type=="radio") {
                    // var html = "<tr id='field_value'><th><i class='require'>*</i>类型值：</th><td><input type='radio' name='field_value' value='1'> 开启 &nbsp <input type='radio' name='field_value' value='0'> 关闭<span><i class='fa fa-exclamation-circle yellow'></i>只有输入类型是【radio】时才需要填写<span></tr>";
                    var html = "<tr id='field_value'><th><i class='require'>*</i>类型值：</th><td><input type='text' name='field_value' class='lg'><p><i class='fa fa-exclamation-circle yellow'></i>只有输入类型是【radio】时才需要填写, 格式参考：0|关闭,1|开启<p></td></tr>";
                    $("#field_type").after(html);

                } else {
                    $("#field_value").remove();
                }
            });
            
        </script>
    </div>
@endsection