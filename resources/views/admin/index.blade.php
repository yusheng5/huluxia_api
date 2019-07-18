@extends('public.boot')
@section('title','主页')
@section('body')
    <nav class="navbar navbar-expand-md bg-dark navbar-dark" style="opacity: 0.7;">
        <a class="navbar-brand" href="">葫芦侠</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">资源</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">社区</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">我的帖子</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">我的回复</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>

    <div class="container">
       <center> <img src="{{$user['avatar']}}" alt="" class="img-fluid" width="20%" height="20%" style="border-radius:50%"></center>
        <div class="card">
            <div class="card-body ">
                <h4 class="card-title">{{$user['nick']}}</h4>
                <p class="card-text">{{$user['signature']}}</p>
                <pre>等级:{{$user['level']}}</pre>
                <pre>年龄:{{$user['age']}}</pre>
                <pre>称号:{{$user['identityTitle']}}</pre>
                <pre>贡献值:{{$user['integral']}}</pre>
                <pre>葫芦:{{$user['credits']}}</pre>
                <a href="/admin/post_show" class="btn btn-info">帖子</a>
                <a href="/admin/Reply" class="btn btn-info">回复</a>
                <a href="" class="btn btn-info">收藏</a>
                <a href="" class="btn btn-info">粉丝<span class="badge badge-secondary">{{$user['followerCount']}}</span></a>
            </div>
        </div>
    </div>
@endsection