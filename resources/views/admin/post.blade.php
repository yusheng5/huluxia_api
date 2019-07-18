@extends('public.pub')
@section('title','帖子列表')
@section('body')

    <div class="container">
        @foreach ($post as $user)
    <div class="items">
        <div class="item">
            <div class="item-heading">
                <div class="pull-right label label-success">{{$user['category']['title']}}</div>
                <h4><a href="/admin/post_new?id={{$user['postID']}}">{{ $user['title'] }}</a></h4>
            </div>
            <div class="item-content">
                @if(!empty($user['images']))
                    <div class="media pull-right">
                        <img src="{{$user['images'][0]}}" width="40%" height="10%">
                    </div>
                @endif
                {{$user['detail']}}
            </div>
            <div class="item-footer">
                <a href="#" class="text-muted"><i class="icon-comments"></i> {{$user['commentCount']}}</a> &nbsp; <span class="text-muted">
                @php
                echo date("y-m-d h:i:s",substr($user['createTime'],0,-3));
                @endphp
                </span>
            </div>
        </div>
    </div>
            @endforeach
            <a href="?page={{($items-20)}}" class="btn btn-link">上一页</a>
            <a href="?page={{$items}}" class="btn btn-link">下一页</a>
    </div>
@endsection