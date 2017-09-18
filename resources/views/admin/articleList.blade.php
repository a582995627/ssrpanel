@extends('admin.layouts')

@section('css')
    <link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('title', '控制面板')
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{url('admin/articleList')}}">文章管理</a>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-docs font-dark"></i>
                            <span class="caption-subject bold uppercase"> 文章管理</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn sbold blue" onclick="addArticle()"> 新增
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> 标题 </th>
                                    <th> 排序 </th>
                                    <th> 发布日期 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($articleList->isEmpty())
                                    <tr>
                                        <td colspan="5">暂无数据</td>
                                    </tr>
                                @else
                                    @foreach($articleList as $article)
                                        <tr class="odd gradeX">
                                            <td> {{$article->id}} </td>
                                            <td> <a href="{{url('user/article?id=' . $article->id)}}" target="_blank"> {{$article->title}} </a> </td>
                                            <td> {{$article->sort}} </td>
                                            <td> {{$article->created_at}} </td>
                                            <td>
                                                <button type="button" class="btn btn-sm blue btn-outline" onclick="editArticle('{{$article->id}}')">编辑</button>
                                                <button type="button" class="btn btn-sm red btn-outline" onclick="delArticle('{{$article->id}}')">删除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$articleList->total()}} 篇文章</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{ $articleList->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        // 添加文章
        function addArticle() {
            window.location.href = '{{url('admin/addArticle')}}';
        }

        // 编辑文章
        function editArticle(id) {
            window.location.href = '{{url('admin/editArticle?id=')}}' + id + '&page=' + '{{Request::get('page', 1)}}';
        }

        // 删除文章
        function delArticle(id) {
            var _token = '{{csrf_token()}}';

            bootbox.confirm({
                message: "确定删除文章？",
                buttons: {
                    confirm: {
                        label: '确定',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: '取消',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.post("{{url('admin/delArticle')}}", {id:id, _token:_token}, function(ret){
                            if (ret.status == 'success') {
                                bootbox.alert(ret.message, function(){
                                    window.location.reload();
                                });
                            } else {
                                bootbox.alert(ret.message);
                            }
                        });
                    }
                }
            });
        }
    </script>
@endsection