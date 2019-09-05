
<ul id="pagenation" class="pagination" style="font-size:30px;">
    <li><p>当前第<span style="color:springgreen">{{$page_info['current_page']}}</span>页 每页<span style="color:springgreen">{{$page_info['page_size']}}</span>条记录  总共<span style="color:springgreen">{{$page_info['last_page']}}</span>页</p></li>
    <li><a href="{{Route($page_info['route'],['page'=>$page_info['current_page']-1])}}"><span style="color:springgreen">上一页</span></a></li>
    <li><a href="{{Route($page_info['route'],['page'=>$page_info['current_page']+1])}}"><span style="color:springgreen">下一页</span></a></li>
    <li>到第<input type="text" id="check_page" style="width: 40px;height: 25px;text-align: center;border: 1px solid springgreen;color:darkslateblue;border-radius: 5px;" value="{{$page_info['current_page']}}">页去</li>
    <input type="hidden" id="url" value="{{Route($page_info['route'])}}">
</ul>
<script type="text/javascript">
    $(function(){
        $("#check_page").keydown(function(e){
            if(e.keyCode == 13){
                var page = $(this).val();
                var _url = $('#url').val();
                window.location.href=_url+'?page='+page;
            }
        })
    })
</script>