@extends('public.pub')
@section('title','登录')
@section('body')

    <div class="container">
        <div class="row bg-warning">
        <center><img src="/image/huluxia.jpg" class="img-circle" width="85px" height="85px"></center>
        </div>
        <div class="row">
            <form action="/user/login" method="post">
                @csrf
                <br>
                <center><div class="input-group col-10 col-sm-8">
                    <span class="input-group-addon"><i class="icon icon-user"></i></span>
                    <input type="text" name="user" class="form-control" placeholder="用户名:">
                </div>
                </center>
                <br>
                <center>
                    <div class="input-group col-10 col-sm-8">
                        <span class="input-group-addon"><i class="icon icon-key"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="密码:">
                    </div>
                </center>
                <br>
                <center>
                    <div class="input-group col-10 col-sm-8">
                        <span class="input-group-addon"><i class="icon icon-keyboard"></i></span>
                        <input type="text" name="key" class="form-control" placeholder="Key:">
                    </div>
                </center>
                <br>
                <center>
                    <button class="btn btn-success btn-lg">登录</button>
                </center>
            </form>
        </div>
    </div>
@endsection