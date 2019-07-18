@extends('public.pub')
@section('title',"回复")
@section('body')
    <meta name="huifu" content="{{$urls['url']}}">
    <script src="/js/app/post.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <nav class="navbar navbar-default " role="navigation">
        <ul class="nav navbar-nav nav-justified ">
            @if($status)
            <li><a href="?user=1"  class="btn-info">用户消息</a></li>
            <li><a href="?system=1" >系统消息</a></li>
            @else
                <li><a href="?user=1"  >用户消息</a></li>
                <li><a href="?system=1" class="btn-info" >系统消息</a></li>
            @endif
        </ul>
    </nav>
    <div class="container" >
{{--        @php--}}
{{--            dump($data);--}}
{{--        @endphp--}}
        @if($status)
            @foreach($data['datas'] as $item)

                <div class="alert alert-success with-icon">
                    <div class="comment">
                        <a href="###" class="avatar">
                            <img src="{{$item['content']['user']['avatar']}}" class="img-circle" width="100%" height="100%">
                        </a>
                        <div class="content">
                            <div class="pull-right text-muted">{{date("y-m-d h:i:s",substr($item['createTime'],0,-3))}}</div>
                            <div><a href="###"><strong>{{$item['content']['user']['nick']}}</strong></a> <span class="text-muted">帖子</span> <a href="/admin/post_new?id={{$item['content']['post']['postID']}}">{{$item['content']['post']['title']}}</a></div>
                            <div class="text">{{$item['content']['text']}}</div>
                            <div class="actions">
                                @php
                                    //dump($item);
                                @endphp
                                <button type="button" data-custom="<input id='text' type='text' name='text' class='form-control'> <center><button class='btn btn-info' onclick='huifu({{$item['content']['commentID']}},{{$item['content']['post']['postID']}})'>回复</button></center>" data-toggle="modal" class="btn btn-danger" >回复</button>
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @foreach($data['datas'] as $item)
                <div class="alert alert-success with-icon">
                    <i class="icon-ok-sign"></i>
                    <div class="content">
                        <h3>{{$item['content']['text']}}</h3>
                        <hr>
                        <h3>审核人: <a href="/admin/user_info?id={{$item['content']['user']['userID']}}" class="card-link">{{$item['content']['user']['nick']}}</a></h3>
                        <h3>时间:{{date('y-m-d H:i:s',substr($item['createTime'],0,-3))}}</h3>
                    </div>
                </div>
{{--                @php--}}
{{--                    dump($item);--}}
{{--                @endphp--}}
            @endforeach
        @endif
    </div>
@endsection