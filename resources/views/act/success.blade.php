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
@include('./../common/navigation')

<div class="ca_success_container">
	<h1>恭喜你成为会员。</h1><br />
	点击 <a href="https://jq.qq.com/?_wv=1027&k=5XPEzLC">https://jq.qq.com/?_wv=1027&k=5XPEzLC</a> 或者QQ搜索624128312加群。很多消息会在群里发布噢。<br /><br />
	更多信息我们已经发送至您的邮箱，请注意查收，若是没有收到，请在垃圾箱查看是否有。
	QQ邮箱个人过滤器十分神奇，他简直就是智障。<br /><br />带来不便请谅解，谢谢。<br />
	也可以扫二维码加群：<br />
	<div class="ca_success_img">
		<img src="{{URL::asset('images/weixin.png')}}" width="200px" />
	</div>
</div>
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}">计算机技术协会</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

</body>
</html>