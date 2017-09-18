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
                <a href="javascript:;">设置</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{url('admin/config')}}">通用配置</a>
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
                            <i class="icon-info font-dark"></i>
                            <span class="caption-subject bold uppercase"> 通用配置 </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <button class="btn sbold blue" data-toggle="modal" data-target="#add_config_modal"> 新增 <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="nav nav-tabs">
                            <li @if(Request::get('tab') == '' || Request::get('tab') == '1') class="active" @endif>
                                <a href="#tab1" data-toggle="tab"> 加密方式 </a>
                            </li>
                            <li @if(Request::get('tab') == '2') class="active" @endif>
                                <a href="#tab2" data-toggle="tab"> 协议 </a>
                            </li>
                            <li @if(Request::get('tab') == '3') class="active" @endif>
                                <a href="#tab3" data-toggle="tab"> 混淆 </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade {{Request::get('tab') == '' || Request::get('tab') == '1' ? 'active in' : ''}}" id="tab1">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> 名称 </th>
                                            <th> 操作 </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($method_list->isEmpty())
                                            <tr>
                                                <td colspan="4">暂无数据</td>
                                            </tr>
                                        @else
                                            @foreach($method_list as $method)
                                                <tr class="odd gradeX">
                                                    <td> {{$method->id}} </td>
                                                    <td> {{$method->name}} @if($method->is_default) <small><span class='label label-info label-sm'>默认</span></small> @endif </td>
                                                    <td>
                                                        @if(!$method->is_default)
                                                            <button type="button" class="btn btn-sm blue btn-outline" onclick="setDefault('1', '{{$method->id}}')">默认</button>
                                                            <button type="button" class="btn btn-sm red btn-outline" onclick="delConfig('1', '{{$method->id}}')">删除</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade {{Request::get('tab') == '2' ? 'active in' : ''}}" id="tab2">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> 名称 </th>
                                            <th> 操作 </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($method_list->isEmpty())
                                            <tr>
                                                <td colspan="4">暂无数据</td>
                                            </tr>
                                        @else
                                            @foreach($protocol_list as $protocol)
                                                <tr class="odd gradeX">
                                                    <td> {{$protocol->id}} </td>
                                                    <td> {{$protocol->name}} @if($protocol->is_default) <small><span class='label label-info label-sm'>默认</span></small> @endif </td>
                                                    <td>
                                                        @if(!$protocol->is_default)
                                                            <button type="button" class="btn btn-sm blue btn-outline" onclick="setDefault('2', '{{$protocol->id}}')">默认</button>
                                                            <button type="button" class="btn btn-sm red btn-outline" onclick="delConfig('2', '{{$protocol->id}}')">删除</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade {{Request::get('tab') == '3' ? 'active in' : ''}}" id="tab3">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> 名称 </th>
                                            <th> 操作 </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($obfs_list->isEmpty())
                                            <tr>
                                                <td colspan="4">暂无数据</td>
                                            </tr>
                                        @else
                                            @foreach($obfs_list as $obfs)
                                                <tr class="odd gradeX">
                                                    <td> {{$obfs->id}} </td>
                                                    <td> {{$obfs->name}} @if($obfs->is_default) <small><span class='label label-info label-sm'>默认</span></small> @endif </td>
                                                    <td>
                                                        @if(!$obfs->is_default)
                                                            <button type="button" class="btn btn-sm blue btn-outline" onclick="setDefault('3', '{{$obfs->id}}')">默认</button>
                                                            <button type="button" class="btn btn-sm red btn-outline" onclick="delConfig('3', '{{$obfs->id}}')">删除</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix margin-top-20"></div>
                        <div id="add_config_modal" class="modal fade" tabindex="-1" data-focus-on="input:first" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">新增配置</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" style="display: none;" id="msg"></div>
                                        <!-- BEGIN FORM-->
                                        <form action="#" method="post" class="form-horizontal">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="type" class="col-md-4 control-label">类型</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="type" id="type">
                                                            <option value="1" selected>加密方式</option>
                                                            <option value="2">协议</option>
                                                            <option value="3">混淆</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-md-4 control-label"> 名称 </label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END FORM-->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">关闭</button>
                                        <button type="button" class="btn red btn-outline" onclick="return addConfig();">提交</button>
                                    </div>
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
        // modal关闭时刷新页面
        $(".modal").on("hidden.bs.modal", function () {
            window.location.reload();
        });

        // 添加配置
        function addConfig() {
            var _token = '{{csrf_token()}}';
            var name = $("#name").val();
            var type = $("#type").val();

            if (name == '') {
                $("#msg").show().html("名称不能为空");
                $("#name").focus();
                return false;
            }

            $.ajax({
                url:'{{url('admin/config')}}',
                type:"POST",
                data:{_token:_token, name:name, type:type},
                beforeSend:function(){
                    $("#msg").show().html("正在添加");
                },
                success:function(ret){
                    if (ret.status == 'fail') {
                        $("#msg").show().html(ret.message);
                        return false;
                    }

                    $("#add_config_modal").modal("hide");
                },
                error:function(){
                    $("#msg").show().html("请求错误，请重试");
                },
                complete:function(){}
            });
        }

        // 删除配置
        function delConfig(tabId, id) {
            var _token = '{{csrf_token()}}';

            bootbox.confirm({
                message: "确定删除配置？",
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
                        $.post("{{url('admin/delConfig')}}", {id:id, _token:_token}, function(ret){
                            if (ret.status == 'success') {
                                bootbox.alert(ret.message, function(){
                                    window.location.href = '{{url('admin/config?tab=')}}' + tabId;
                                });
                            } else {
                                bootbox.alert(ret.message);
                            }
                        });
                    }
                }
            });
        }

        // 置为默认
        function setDefault(tabId, id) {
            var _token = '{{csrf_token()}}';

            $.ajax({
                type: "POST",
                url: "{{url('admin/setDefaultConfig')}}",
                async: false,
                data: {_token:_token, id: id},
                dataType: 'json',
                success: function (ret) {
                    if (ret.status == 'success') {
                        window.location.href = '{{url('admin/config?tab=')}}' + tabId;
                    } else {
                        bootbox.alert(ret.message);
                    }
                }
            });
        }
    </script>
@endsection