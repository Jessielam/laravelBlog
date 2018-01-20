@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/article')}}">文章列表</a> &raquo; 文章详情
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>文章详情</h3>
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
                <!-- <a href="#"><i class="fa fa-plus"></i>新增文章</a> -->
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/article/' . $article->arc_id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="put">
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>所属栏目：</th>
                        <td>
                            <select name="cate_id" style="width: 150px;">
                                @foreach($cateData as $category)
                                    <option value="{{$category->cate_id}}" @if($article->cate_id == $category->cate_id) selected @endif>{{$category->_cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="arc_title" value="{{$article->arc_title}}">
                        </td>
                    </tr>
                    <tr>
                        <th>作者：</th>
                        <td>
                            <input type="text" name="arc_author" value="{{$article->arc_author}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>缩略图：</th>
                        <td>
                            <input type="text" size="50" name="arc_thumb" value="{{$article->arc_thumb}}">
                            <input id="file_upload" name="arc_pic" type="file" multiple="true">
                            <script src="{{asset('uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                            <link rel="stylesheet" type="text/css" href="{{asset('uploadify/uploadify.css')}}">
                            <script type="text/javascript">
                                <?php $timestamp = time();?>
                                $(function() {
                                    $('#file_upload').uploadify({
                                        'buttonText'   : '图片上传',
                                        'formData'     : {
                                            'timestamp' : '<?php echo $timestamp;?>',
                                            '_token'     : '{{csrf_token()}}'
                                        },
                                        'swf'      : "{{asset('uploadify/uploadify.swf')}}",
                                        'uploader' : "{{url('admin/upload')}}",
                                        'onUploadSuccess' : function(file, data, response) {
                                            $('input[name=arc_thumb]').val(data);
                                            $('#arc_thumb_img').attr('src', data);
                                        }
                                    });
                                });
                            </script>
                            <style>
                                .uploadify{display:inline-block;}
                                .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                                table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                            </style>
                        </td>
                    </tr>
                     <tr>
                        <th></th>
                        <td>
                            <img src="{{$article->arc_thumb}}" alt="" id="arc_thumb_img" style="max-width: 350px; max-height: 100px;">
                        </td>
                    </tr>
                    <tr>
                        <th>标签：</th>
                        <td>
                            @foreach($tagData as $tag)
                            <label class="checkbox-inline">
                                <input type="checkbox" name="arc_tag[]" @if(in_array($tag->tag_id, $arcTags)) checked @endif value="{{$tag->tag_id}}">{{$tag->tag_name}}
                            </label>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>博文摘要：</th>
                        <td>
                            <textarea name="arc_digest">{{$article->arc_digest}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>博文内容：</th>
                        <td>
                        <!--引入百度编辑器 -->
                <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
                <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
                <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" name="arc_content" type="text/plain" style="width:768px;height:200px;">{!! $article->arc_content !!}</script>
                        <script type="text/javascript">
                            var ue = UE.getEditor('editor');
                        </script>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="保存">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection