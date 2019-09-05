<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <style media="screen">
        body {
            overflow: hidden;
        }
        .heart-body {
            width: 500px;
            margin: 100px auto;
            position: relative;
        }
        .snowfall-flakes:before,
        .snowfall-flakes:after {
            content: "";
            position: absolute;
            left: 0px;
            top: 0px;
            display: block;
            width: 30px;
            height: 46px;
            background: red;
            border-radius: 50px 50px 0 0;
        }
        .snowfall-flakes:before {
            -webkit-transform: rotate(-45deg);
            /* Safari 和 Chrome */
            -moz-transform: rotate(-45deg);
            /* Firefox */
            -ms-transform: rotate(-45deg);
            /* IE 9 */
            -o-transform: rotate(-45deg);
            /* Opera */
            transform: rotate(-45deg);
        }
        .snowfall-flakes:after {
            left: 13px;
            -webkit-transform: rotate(45deg);
            /* Safari 和 Chrome */
            -moz-transform: rotate(45deg);
            /* Firefox */
            -ms-transform: rotate(45deg);
            /* IE 9 */
            -o-transform: rotate(45deg);
            /* Opera */
            transform: rotate(45deg);
        }
    </style>
</head>
<body>
<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="js/snowfall.jquery.js"></script>
<form action={{route('logout')}} method="post">
    @csrf
    <input type="text" name="name"/>
    <input type="submit" value="确定"/>
</form>
<body>
<div id="first">
    你是:<input type="text" id="name"/><button id="bu1">确定</button>
</div>
<div style="display: none" id="yy">
    你现在最想的是谁:<input type="text" id="he"/><button id="bu2">确定</button>
</div>
</body>
<script>
    //调用飘落函数 实现飘落效果
    //    $(document).snowfall({
    //        flakeCount: 50 //爱心的个数
    //    });
    $("#bu1").click(function(){
        if($("#name").val() =='小张阿姨' || $("#name").val() =='张佳艳'){
            $("#yy").show();
            $("#first").hide();
        }
        else{
            alert('除了她别人不许玩 嘻嘻');
            return false;
        }
    })
    $("#bu2").click(function(){
        if($("#he").val() =='小沈叔叔' || $("#he").val() =='沈风雷'){
            alert('我也想你了~');
            $("body").css('background-color','pink');
            //调用飘落函数 实现飘落效果
            $(document).snowfall({
                flakeCount: 100 //爱心的个数
            });
        }
        else{
            alert('居然背着我想别人?给我退出去!')
            return false;
        }
    })
</script>
</body>
</html>