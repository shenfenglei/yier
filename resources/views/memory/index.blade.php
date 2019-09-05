@extends('layouts.app')
@section('css_content')
    .alert{
    display:none;
    }
    .none{
    display:none;
    }
@stop

@section('content')
    <div id="example" style="text-align: center"> <ul id="pageLimit"></ul> </div>
    <div class="container">
        <h2 class="text-white">备忘录列表</h2>
        <button type="button" class="btn btn-primary btn-secondary" data-toggle="modal" data-target="#addMemModel" id="add">新增</button>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>创建时间</th>
                <th>提醒时间</th>
                <th>内容</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{$item->created_at}}</td>
                    <td>
                        @if ($item->type == 2)
                            每月{{$item->finish_time}}
                            @else
                            {{$item->finish_time}}
                        @endif
                    </td>
                    <td>{{$item->content}}</td>
                    <td>@if ($item->status == 0)
                            未通知
                        @elseif ($item->status == 1)
                            已通知
                    @endif
                    </td>
                    <td><input type="hidden" value="{{$item->id}}"><button class="but_del btn btn-primary btn-secondary">删除</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @component('public.page',['page_info'=>$page_info])
        @endcomponent
    </div>
    <!-- 模态框 -->
    <div class="modal fade" id="addMemModel">
        <div class="alert alert-warning">
            <span id="alert_msg">警告! 请完成内容!</span>
        </div>
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark">新增备忘</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- 模态框主体 -->
                <div class="modal-body">
                    <form class="form-horizontal text-dark" role="form" id="mem_form" action="{{url('yier/memAdd')}}">
                        <div class="form-group row">
                            <div class="col-2">
                                <label for="mem_text" class="control-label">类型</label>
                            </div>
                            <div class="col-8">
                                <select class="form-control" name="type" id="type">
                                    <option value="1">单日提醒</option>
                                    <option value="2">每月提醒</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label for="mem_time" class="control-label">时间</label>
                            </div>
                            <div class="col-8 time1">
                                    <input class="flatpickr form-control" data-default-date="today" data-enable-time=true data-enable-seconds=true name="mem_time" id="mem_time" data-date-format="" placeholder="选择提醒时间">
                            </div>
                            <div class="col-2 time2 none">
                                每月
                            </div>
                            <div class="col-6 time2 none">
                                <input class="flatpickr2 form-control"  data-enable-time=true data-default-date="today" data-enable-seconds=false data-no-calendar=false name="mem_time" id="mem_time" data-date-format="d H:i" disabled>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label for="mem_text" class="control-label">内容</label>
                            </div>
                            <div class="col-8">
                                <textarea class="form-control" id="mem_text" name="mem_text" placeholder="请输入备忘内容"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button id="mem_submit" type="button" class="btn btn-primary">确定</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                </div>

            </div>
        </div>
    </div>

    <script>

        $(function(){
            document.getElementsByClassName("flatpickr").flatpickr({
                minDate: "today",
            });
            document.getElementsByClassName("flatpickr2").flatpickr({
                dateFormat: "d H:i",
            });
            $("#mem_submit").click(function(){
                if($("#mem_time").val() != '' && $("#mem_text").val() != ''){
                    $("#mem_form").submit();
                }
                else{
                    $(".alert-warning").show();
                }
            })

            $(".but_del").on('click',function(){
                var id = $(this).prev().val();
                $.ajax({
                    url :"/yier/delMem",
                    type:'GET',
                    dataType:'json',
                    data:{id:id},
                    success:function(data){
                        if(data ==1){
                            window.location.reload();
                        }
                        else{
                            alert('删除失败');
                        }
                    }
                })
            })
            $("#type").change(function(){
                var type = $("#type option:selected").val();
                if(type == 1){
                    $(".time2").addClass('none');
                    $(".time1").removeClass('none');
                    $(".flatpickr").attr('disabled',false);
                    $(".flatpickr2").attr('disabled',true);
                }
                else{
                    $(".time1").addClass('none');
                    $(".time2").removeClass('none');
                    $(".flatpickr").attr('disabled',true);
                    $(".flatpickr2").attr('disabled',false);
                }
            })
        })
    </script>
@stop

