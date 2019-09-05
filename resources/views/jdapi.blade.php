@extends('base.content')

@section('title','fenglei')
@section('js_in')
    <script type="text/javascript" src="/js/jquery.qrcode.min.js"></script>
@stop
@section('main')
    <div id="code"></div>
    <table id="dev_code"></table>
    <form action="/getjdapi">
        <input  type="submit" id="" value="提交">
    </form>
    <script type="text/javascript">
    </script>
@stop