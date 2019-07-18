<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="refresh" content="5;url={{$error['url']}}" />
    <title>{{$error['title']}}</title>
    <link href="/404/css/bootstrap.css" rel="stylesheet" />
    <link href="/404/css/font-awesome.min.css" rel="stylesheet" />
 <link href='http://fonts.googleapis.com/css?family=Nova+Flat' rel='stylesheet' type='text/css'>
    <link href="/404/css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
          <div class="row pad-top text-center">
                 <div class="col-md-6 col-md-offset-3 text-center">
                  <h1> {{$error['msg']}}</h1>
              <span id="error-link" status="{{$error['code']}}"></span>
                     <h2>! 错误提示 !</h2>
</div>
        </div>

            <div class="row text-center">
                 <div class="col-md-8 col-md-offset-2">
                     
                     <h3> <i  class="fa fa-lightbulb-o fa-5x"></i> </h3>
               <a href="{{$error['link']}}" class="btn btn-primary"><span class="second">5</span>秒后自动返回网站首页</a>
</div>
        </div>

    </div>
	<script type="text/javascript">
		$(function() {
			var wait = $(".second").html();
			timeOut();
			/**
			 * 实现倒计时
			 */
			function timeOut() {
				if(wait != 0) {
					setTimeout(function() {
						$('.second').text(--wait);
						timeOut();
					}, 1000);
				}
			}
		});
	</script>
    <script src="/404/js/jquery-1.10.2.js"></script>
    <script src="/404/js/bootstrap.js"></script>
    <script src="/404/js/countUp.js"></script>
    <script src="/404/js/custom.js"></script>
</body>
</html>
