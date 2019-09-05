@extends('base.content')

@section('title','fenglei')
@section('js_in')
    <script type="text/javascript" src="/js/jquery.qrcode.min.js"></script>
@stop
@section('main')
    <div id="code"></div>
    <table id="dev_code"></table>
    <script type="text/javascript">
        $(function(){
            // $("#code").qrcode(utf16to8('爱你哦 小张'));

            $("#dev_code").qrcode({
                render: "table", //也可以替换为table
                foreground: "#C00",
                width:500,
                height:500,
                background: "#FFF",
                text: utf16to8('http://yierbaby.top/miss')
            })
        })

        function utf16to8(str) {
            var out, i, len, c;
            out = "";
            len = str.length;
            for (i = 0; i < len; i++) {
                c = str.charCodeAt(i);
                if ((c >= 0x0001) && (c <= 0x007F)) {
                    out += str.charAt(i);
                } else if (c > 0x07FF) {
                    out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));
                    out += String.fromCharCode(0x80 | ((c >> 6) & 0x3F));
                    out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
                } else {
                    out += String.fromCharCode(0xC0 | ((c >> 6) & 0x1F));
                    out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
                }
            }
            return out;
        }
    </script>
@stop