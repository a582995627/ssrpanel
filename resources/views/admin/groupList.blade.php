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
                <a href="javascript:;">节点管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/groupList')}}">节点分组列表</a>
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
                            <i class="icon-grid font-dark"></i>
                            <span class="caption-subject bold uppercase"> 节点分组列表 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn sbold blue" onclick="addGroup()"> 新增
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> 分组名称 </th>
                                    <th> 可见级别 </th>
                                    <th> 操作 </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($groupList->isEmpty())
                                        <tr>
                                            <td colspan="4">暂无数据</td>
                                        </tr>
                                    @else
                                        @foreach($groupList as $group)
                                            <tr class="odd gradeX">
                                                <td> {{$group->id}} </td>
                                                <td> {{$group->name}} </td>
                                                <td>
                                                    @if($group->level == 1)
                                                        <span class="label label-default">倔强青铜</span>
                                                    @elseif ($group->level == 2)
                                                        <span class="label label-primary">秩序白银</span>
                                                    @elseif ($group->level == 3)
                                                        <span class="label label-info">荣耀黄金</span>
                                                    @elseif ($group->level == 4)
                                                        <span class="label label-success">尊贵铂金</span>
                                                    @elseif ($group->level == 5)
                                                        <span class="label label-warning">永恒钻石</span>
                                                    @elseif ($group->level == 6)
                                                        <span class="label label-danger">至尊黑曜</span>
                                                    @else
                                                        <span class="label label-danger">最强王者</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm blue btn-outline" onclick="editGroup('{{$group->id}}')">编辑</button>
                                                    <button type="button" class="btn btn-sm red btn-outline" onclick="delGroup('{{$group->id}}')">删除</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="dataTables_info" role="status" aria-live="polite">共 {{$groupList->total()}} 个节点</div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="dataTables_paginate paging_bootstrap_full_number pull-right">
                                    {{$groupList->links()}}
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
        // 添加节点分组
        function addGroup() {
            window.location.href = '{{url('admin/addGroup')}}';
        }

        // 编辑节点分组
        function editGroup(id) {
            window.location.href = '{{url('admin/editGroup?id=')}}' + id + '&page=' + '{{Request::get('page', 1)}}';
        }

        // 删除节点分组
        function delGroup(id) {
            bootbox.confirm({
                message: "确定删除节点？",
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
                        $.post("{{url('admin/delGroup')}}", {_token:'{{csrf_token()}}', id:id}, function(ret){
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