@extends('layouts.app')
@section('css_content')
    .alert{
    display:none;
    }
@stop

@section('content')
    <div id="example" style="text-align: center"> <ul id="pageLimit"></ul> </div>
    <div class="container">
        <h2 class="text-white">收支明细列表</h2>
        <p style="line-height: 30px;margin-left: 10%;color:white">
            @if (!empty($content))
                关于<span class="text-warning">{{$content}}</span>的
            @endif
            今日支出:<span class="text-danger">{{$total['today_pay']}}</span>元,今日收入:<span class="text-success">{{$total['today_get']}}</span>元;</p>
        <p style="line-height: 30px;margin-left: 10%;color:white">

            @if (!empty($content))
                关于<span class="text-warning">{{$content}}</span>的
            @endif
            当月支出:<span class="text-danger">{{$total['month_pay']}}</span>元,当月收入:<span class="text-success">{{$total['month_get']}}</span>元;</p>
        <p style="line-height: 30px;margin-left: 10%;color:white">

            @if (!empty($content))
                关于<span class="text-warning">{{$content}}</span>的
            @endif今年支出:<span class="text-danger">{{$total['year_pay']}}</span>元,今年收入:<span class="text-success">{{$total['year_get']}}</span>元;</p>
        <form action="{{url('yier/accountIndex')}}" role="form" class="form-inline" style="padding-bottom: 30px;">
            <div class="form-group">
            <button type="button" class="btn btn-primary btn-secondary" data-toggle="modal" data-target="#addMemModel" id="add">新增</button>
            </div>
            <div class="form-group" style="margin-left: 10px;">
                {{--<label for="content" style="margin-left: 100px;" class="text-white">内容: </label>&nbsp;&nbsp;&nbsp;--}}
                <span class="text-white">内容:</span>
                <input type="text" name="content1" id="content1" />&nbsp;&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <button type="submit"  class="btn btn-primary btn-secondary">搜索</button>
            </div>
        </form>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>发生时间</th>
                <th>变动金额</th>
                <th>内容</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->num}}</td>
                    <td>{{$item->content}}</td>
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
            <span id="alert_msg">请完成内容</span>
        </div>
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title text-dark">新增收支明细</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- 模态框主体 -->
                <div class="modal-body">
                    <form class="form-horizontal text-dark" role="form" id="mem_form" action="{{url('yier/accountAdd')}}">
                        <div class="form-group row">
                            <div class="col-2">
                                <label for="type" class="control-label">类型</label>
                            </div>
                            <div class="col-8">
                                <select name="type" id="type">
                                    <option value="1">支出</option>
                                    <option value="2">收入</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label for="num" class="control-label">金额</label>
                            </div>
                            <div class="col-8">
                                <input  type="number"  name="num" id="num"  placeholder="请输入金额">

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2">
                                <label for="mem_text" class="control-label">内容</label>
                            </div>
                            <div class="col-8">
                                <textarea class="form-control" id="content" name="content" placeholder="请输入收支内容"></textarea>
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
            $("#mem_submit").click(function(){
                var msg = '警告!';
                if(isNaN($("#num").val()) || $("#num").val() ==''){
                    msg +='请填写数字!'
                }
                if($("#content").val() == ''){
                    msg +='请填写内容'
                }
                if(msg != '警告!'){
                    $("#alert_msg").text(msg);
                    $(".alert-warning").show();
                }
                else{
                    $("#mem_form").submit();
                }
            })

            $(".but_del").on('click',function(){
                var id = $(this).prev().val();
                if(!confirm('确定删除这条记录吗?')){
                    return;
                }
                $.ajax({
                    url :"/yier/delAccount",
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
        })

    </script>
@stop

