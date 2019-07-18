@extends('public.pub')
@section('title',"{$data['post']['title']}")
@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="huifu" content="{{$urls['url']}}">
    <script src="/js/app/post.js">
        // function huifu(comment_id,post_id) {
        //     alert(comment_id);
        // }
    </script>
    <article class="article">
        <header>
            <h1 class="text-center">{{$data['post']['title']}}</h1>
            <dl class="dl-inline">
                <dt>贴主:</dt>
                <dd>{{$data['post']['user']['nick']}}</dd>
                <dt>最后修订：</dt>
                <dd>{{date("y-m-d h:i:s",substr($data['post']['updateTime'],0,-3))}}</dd>
                <dt></dt>
                <dd class="pull-right"><span class="label label-success">{{$data['post']['category']['title']}}</span> <span class="label label-warning">{{$data['post']['category']['description']}}</span> <span class="label label-info">{{$data['post']['category']['postCountFormated']}}</span></dd>
            </dl>
        </header>
        <section class="content">
            <blockquote>
                <p>{{$data['post']['detail']}}</p>
                @if(!empty($data['post']['images']))
                    @foreach($data['post']['images'] as $scr)
{{--                        <img src="{{$scr}}" width="40%" height="40%">--}}
                        <img src="{{$scr}}" width="200px" height="200px" class="img-responsive">
                    @endforeach
                @endif
            </blockquote>
            @foreach ($data['comments'] as $item)

            <div class="comment">
                <a href="###" class="avatar">
                    <img src="{{$item['user']['avatar']}}" width="100%" height="100%">
                </a>
                <div class="content">
                    <div class="pull-right text-muted">{{date("y-m-d h:i:s",substr($item['createTime'],0,-3))}}</div>
                    <div><a href="###"><strong>{{$item['user']['nick']}}</strong></a>
                        @if(!empty($item['refComment']))
                        <span class="text-muted">回复</span> <a href="###">{{$item['refComment']['nick']}}</a>
                        @endif
                    </div>
                    <div class="text" comment_id="{{$item['commentID']}}">{{$item['text']}}</div>
                    <div class="actions">
{{--                        href="./post_h?c={{$item['commentID']}}&p={{$data['post']['postID']}}"--}}
{{--                        onclick="huifu({{$item['commentID']}},{{$data['post']['postID']}})"--}}
                        <button type="button" data-custom="<input id='text' type='text' name='text' class='form-control'> <center><button class='btn btn-info' onclick='huifu({{$item['commentID']}},{{$data['post']['postID']}})'>回复</button></center>" data-toggle="modal" class="btn btn-danger" >回复</button>
                    </div>
                </div>
            </div>

            @endforeach
        </section>
        <footer style="position:absolute;bottom:0;width:85%;">
{{--            <ul class="pager pager-justify">--}}
{{--                <li class="previous"><a target="_blank" href="?id={{$pages}}"><i class="icon-arrow-left"></i> 下一贴</a></li>--}}
{{--                <li class="next disabled"><a target="_blank" href="?id={{$page}}">上一帖<i class="icon-arrow-right"></i></a></li>--}}
{{--            </ul>--}}
        </footer>
    </article>
@endsection