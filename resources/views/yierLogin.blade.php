@extends('layouts.app')

@section('css_content')
.nav-link{
    font-size:20px;
    color:white;
}
@stop
@section('content')
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/yier/memoryIndex')}}">备忘录</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{Route('accountIndex')}}">收支记录</a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">Link</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link disabled" href="#">Disabled</a>--}}
            {{--</li>--}}
        </ul>
@stop