@extends('layouts.admin')
        @section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 添加文章分类
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>快捷操作</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="#"><i class="fa fa-plus"></i>新增分类</a>
            {{--<a href="#"><i class="fa fa-recycle"></i>批量删除</a>--}}
            {{--<a href="#"><i class="fa fa-refresh"></i>更新排序</a>--}}
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/category/'.$field->cate_id)}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>父级分类：</th>
                <td>
                    <select name="cate_pid">
                        <option value="0">==请选择==</option>
                        @foreach($data as $d)
                            <option value="{{$d->cate_id}}"
                            @if($d->cate_id==$field->cate_pid)
                                selected
                            @endif
                            >{{$d->cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>分类名称：</th>
                <td>
                    <input type="text" name="cate_name" value="{{$field->cate_name}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th>分类标题：</th>
                <td>
                    <input type="text" name="cate_title" value="{{$field->cate_title}}">
                </td>
            </tr>
            <tr>
                <th>关键词：</th>
                <td>
                    <input type="text" class="sm" name="cate_keywords" value="{{$field->cate_keywords}}">
                </td>
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="cate_description">{{$field->cate_description}}</textarea>
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td><input type="text" class="sm" name="cate_order" value="{{$field->cate_order}}"></td>
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
