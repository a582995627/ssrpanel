@extends('admin.layouts')

@section('css')
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
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
                <a href="{{url('admin/groupList')}}">节点分组</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="javascript:;">编辑节点分组</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light form-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-green sbold uppercase">编辑节点分组</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        @if (Session::has('errorMsg'))
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <strong>错误：</strong> {{Session::get('errorMsg')}}
                            </div>
                        @endif
                        <!-- BEGIN FORM-->
                        <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return do_submit();">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">分组名称</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" value="{{$group->name}}" id="name" placeholder="" autofocus required>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">可见级别</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="level" id="level" required>
                                            <option value="1" {{$group->level == 1 ? 'selected' : ''}}>倔强青铜</option>
                                            <option value="2" {{$group->level == 2 ? 'selected' : ''}}>秩序白银</option>
                                            <option value="3" {{$group->level == 3 ? 'selected' : ''}}>荣耀黄金</option>
                                            <option value="4" {{$group->level == 4 ? 'selected' : ''}}>尊贵铂金</option>
                                            <option value="5" {{$group->level == 5 ? 'selected' : ''}}>永恒钻石</option>
                                            <option value="6" {{$group->level == 6 ? 'selected' : ''}}>至尊黑曜</option>
                                            <option value="7" {{$group->level == 7 ? 'selected' : ''}}>最强王者</option>
                                        </select>
                                        <span class="help-block">对应账号级别可见该分组下的节点（向下兼容）</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"> <i class="fa fa-check"></i> 提 交</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        // ajax同步提交
        function do_submit() {
            var _token = '{{csrf_token()}}';
            var name = $('#name').val();
            var level = $("#level option:selected").val();

            $.ajax({
                type: "POST",
                url: "{{url('admin/editGroup')}}",
                async: false,
                data: {_token:_token, id:'{{$group->id}}', name:name, level:level},
                dataType: 'json',
                success: function (ret) {
                    if (ret.status == 'success') {
                        bootbox.alert(ret.message, function () {
                            window.location.href = '{{url('admin/groupList')}}';
                        });
                    } else {
                        bootbox.alert(ret.message);
                    }
                }
            });

            return false;
        }
    </script>
@endsection