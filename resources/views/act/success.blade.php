<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/success.css')}}" />
<title>
报名成功
</title>
</head>
<body>
<!--[if lte IE 9 ]>
<div class="am-alert am-alert-danger ie-warning" data-am-alert>
  <button type="button" class="am-close">&times;</button>
  <div class="am-container">
    365 安全卫士提醒：你的浏览器太古董了，妹子无爱，<a
    href="http://browsehappy.com/" target="_blank">速速点击换一个</a>！</div></div>
<![endif]-->
@include('./../common/navigation')

<div class="ca_success_container">
	<h1>恭喜你报名成功。</h1><br />
	请加群603987935。学习是在群里展开的噢。<br /><br />
	更多信息我们已经发送至您的邮箱，请注意查收，若是没有收到，请在垃圾箱查看是否有。
	QQ邮箱个人过滤器十分神奇，他简直就是智障。<br /><br />带来不便请谅解，谢谢。<br />
	也可以扫二维码加群：<br /><br />
	<div class="ca_success_img">
		<img src="{{URL::asset('images/weixin.png')}}" width="200px" />
	</div>
</div>
@include('./../common/bottom')

</body>
</html>