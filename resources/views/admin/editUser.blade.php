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
                <a href="{{url('admin/userList')}}">账号管理</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="javascript:;">编辑账号</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="tab-pane active">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="{{url('admin/editUser')}}" method="post" class="form-horizontal" onsubmit="return do_submit();">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- BEGIN SAMPLE FORM PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject font-dark bold uppercase">账号信息</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label for="username" class="col-md-3 control-label">用户名</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="username" value="{{$user->username}}" id="username" placeholder="不填则不变" autofocus required>
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-md-3 control-label">密码</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="password" value="" id="password" placeholder="不填则不变">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="usage" class="col-md-3 control-label">用途</label>
                                                <div class="col-md-8">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="usage" value="1" {{$user->usage == 1 ? 'checked' : ''}}> 手机
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="usage" value="2" {{$user->usage == 2 ? 'checked' : ''}}> 电脑
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="usage" value="3" {{$user->usage == 3 ? 'checked' : ''}}> 路由器
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="usage" value="4" {{$user->usage == 4 ? 'checked' : ''}}> 其他
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pay_way" class="col-md-3 control-label">付费方式</label>
                                                <div class="col-md-8">
                                                    <div class="mt-radio-inline">
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="0" {{$user->pay_way == 0 ? 'checked' : ''}}> 月付
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="1" {{$user->pay_way == 1 ? 'checked' : ''}}> 月付
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="2" {{$user->pay_way == 2 ? 'checked' : ''}}> 半年付
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio">
                                                            <input type="radio" name="pay_way" value="3" {{$user->pay_way == 3 ? 'checked' : ''}}> 年付
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="balance" class="col-md-3 control-label">级别</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="level" id="level">
                                                        <option value="1" {{$user->level == 1 ? 'selected' : ''}}>倔强青铜</option>
                                                        <option value="2" {{$user->level == 2 ? 'selected' : ''}}>秩序白银</option>
                                                        <option value="3" {{$user->level == 3 ? 'selected' : ''}}>荣耀黄金</option>
                                                        <option value="4" {{$user->level == 4 ? 'selected' : ''}}>尊贵铂金</option>
                                                        <option value="5" {{$user->level == 5 ? 'selected' : ''}}>永恒钻石</option>
                                                        <option value="6" {{$user->level == 6 ? 'selected' : ''}}>至尊黑曜</option>
                                                        <option value="7" {{$user->level == 7 ? 'selected' : ''}}>最强王者</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="balance" class="col-md-3 control-label">余额</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="balance" value="{{$user->balance}}" id="balance" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="score" class="col-md-3 control-label">积分</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="score" value="{{$user->score}}" id="score" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">有效期</label>
                                                <div class="col-md-8">
                                                    <div class="input-group input-large input-daterange">
                                                        <input type="text" class="form-control" name="enable_time" value="{{$user->enable_time}}" id="enable_time">
                                                        <span class="input-group-addon"> 至 </span>
                                                        <input type="text" class="form-control" name="expire_time" value="{{$user->expire_time}}" id="expire_time">
                                                    </div>
                                                    <span class="help-block"> 留空默认为一年 </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="col-md-3 control-label">状态</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="status" value="{{$user->status}}" id="status">
                                                        <option value="1" @if($user->status == '1') selected @endif>正常</option>
                                                        <option value="0" @if($user->status == '0') selected @endif>未激活</option>
                                                        <option value="-1" @if($user->status == '-1') selected @endif>禁用</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="wechat" class="col-md-3 control-label">微信</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="wechat" value="{{$user->wechat}}" id="wechat" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="qq" class="col-md-3 control-label">QQ</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="qq" value="{{$user->qq}}" id="qq" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="is_admin" class="col-md-3 control-label">管理员</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="is_admin" id="is_admin">
                                                        <option value="0" {{$user->is_admin == 0 ? 'selected' : ''}}>否</option>
                                                        <option value="1" {{$user->is_admin == 1 ? 'selected' : ''}}>是</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="remark" class="col-md-3 control-label">备注</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" rows="3" name="remark" id="remark">{{$user->remark}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE FORM PORTLET-->
                                </div>
                                <div class="col-md-6">
                                    <!-- BEGIN SAMPLE FORM PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject font-dark bold">SS(R)信息</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label for="port" class="col-md-3 control-label">端口</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="port" value="{{$user->port}}" id="port" placeholder="" aria-required="true" aria-invalid="true" aria-describedby="number-error" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="passwd" class="col-md-3 control-label">密码</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" name="passwd" value="{{$user->passwd}}" id="passwd" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success" type="button" onclick="makePasswd()">
                                                                <i class="fa fa-arrow-left fa-fw" /></i> 生成 </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="method" class="col-md-3 control-label">加密方式</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="method" id="method">
                                                        @foreach ($method_list as $method)
                                                            <option value="{{$method->name}}" @if($method->name == $user->method) selected @endif>{{$method->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="transfer_enable" class="col-md-3 control-label">可用流量</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="transfer_enable" value="{{$user->transfer_enable}}" id="transfer_enable" placeholder="" required>
                                                        <span class="input-group-addon">GiB</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="enable" class="col-md-3 control-label">状态</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="enable" value="{{$user->enable}}" id="enable">
                                                        <option value="1" {{$user->enable ? 'selected' : ''}}>启用</option>
                                                        <option value="0" {{$user->enable ? '' : 'selected'}}>禁用</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="protocol" class="col-md-3 control-label">协议</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="protocol" id="protocol">
                                                        @foreach ($protocol_list as $protocol)
                                                            <option value="{{$protocol->name}}" @if($protocol->name == $user->protocol) selected @endif>{{$protocol->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="protocol_param" class="col-md-3 control-label">协议参数</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="protocol_param" value="{{$user->protocol_param}}" id="protocol_param" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="obfs" class="col-md-3 control-label">混淆</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="obfs" id="obfs">
                                                        @foreach ($obfs_list as $obfs)
                                                            <option value="{{$obfs->name}}" @if($obfs->name == $user->obfs) selected @endif>{{$obfs->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="obfs_param" class="col-md-3 control-label">混淆参数</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" rows="5" name="obfs_param" id="obfs_param">{{$user->obfs_param}}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="speed_limit_per_con" class="col-md-3 control-label">单连接限速</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="speed_limit_per_con" value="{{$user->speed_limit_per_con}}" id="speed_limit_per_con" placeholder="" required>
                                                        <span class="input-group-addon">KB</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="speed_limit_per_user" class="col-md-3 control-label">单用户限速</label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="speed_limit_per_user" value="{{$user->speed_limit_per_user}}" id="speed_limit_per_user" placeholder="" required>
                                                        <span class="input-group-addon">KB</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE FORM PORTLET-->
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-4">
                                        <button type="submit" class="btn green">提 交</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
@endsection
@section('script')
    <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        // 有效期
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                language: 'zh-CN',
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });
        });

        // ajax同步提交
        function do_submit() {
            var _token = '{{csrf_token()}}';
            var id = '{{Request::get('id')}}';
            var username = $('#username').val();
            var password = $('#password').val();
            var usage = $("input:radio[name='usage']:checked").val();
            var pay_way = $("input:radio[name='pay_way']:checked").val();
            var balance = $('#balance').val();
            var score = $('#score').val();
            var status = $('#status').val();
            var enable_time = $('#enable_time').val();
            var expire_time = $('#expire_time').val();
            var wechat = $('#wechat').val();
            var qq = $('#qq').val();
            var is_admin = $('#is_admin').val();
            var remark = $('#remark').val();
            var level = $("#level option:selected").val();
            var port = $('#port').val();
            var passwd = $('#passwd').val();
            var method = $('#method').val();
            var custom_method = $('#custom_method').val();
            var transfer_enable = $('#transfer_enable').val();
            var enable = $('#enable').val();
            var protocol = $('#protocol').val();
            var protocol_param = $('#protocol_param').val();
            var obfs = $('#obfs').val();
            var obfs_param = $('#obfs_param').val();
            var speed_limit_per_con = $('#speed_limit_per_con').val();
            var speed_limit_per_user = $('#speed_limit_per_user').val();

            $.ajax({
                type: "POST",
                url: "{{url('admin/editUser')}}",
                async: false,
                data: {_token:_token, id:id, username: username, password:password, usage:usage, pay_way:pay_way, balance:balance, score:score, status:status, enable_time:enable_time, expire_time:expire_time, wechat:wechat, qq:qq, is_admin:is_admin, remark:remark, level:level, port:port, passwd:passwd, method:method, custom_method:custom_method, transfer_enable:transfer_enable, enable:enable, protocol:protocol, protocol_param:protocol_param, obfs:obfs, obfs_param:obfs_param, speed_limit_per_con:speed_limit_per_con, speed_limit_per_user:speed_limit_per_user},
                dataType: 'json',
                success: function (ret) {
                    if (ret.status == 'success') {
                        bootbox.alert(ret.message, function(){
                            window.location.href = '{{url('admin/userList?page=') . Request::get('page')}}';
                        });
                    } else {
                        bootbox.alert(ret.message);
                    }
                }
            });

            return false;
        }

        // 生成随机密码
        function makePasswd() {
            $.get("{{url('admin/makePasswd')}}",  function(ret) {
                $("#passwd").val(ret);
            });
        }
    </script>
@endsection