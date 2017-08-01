<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/about.css')}}" />
<title>
协会招新
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

<div class="ca_about_container">
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/about.js')}}"></script>
<script type="text/javascript">
$(function(){
	var about=new about_function();
})
</script>
</body>
</html>