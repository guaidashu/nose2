<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/project.css')}}" />
<title>
项目中心
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

<!--新改的部分-->
<div class="ca_about_container">
	<div class="project1" name="project1">
		<div class="project1_right" name="project1_right">
			<a href="http://sh.wyysdsa.cn/" class="project_a" target="_blank"><h1>Super Homework</h1></a>
			Super Homework是一个可以发布作业，在线答疑，答题监控，在线执行源代码的网页。<br/>
			通过绑定学校的教务系统，进准定位方便快捷接受作业信息，老师根据班级发布各类作业、
			在线批改学生作业完成情况Excel导出。
		</div>
		<div class="project1_left" name="project1_left">
			<a href="http://sh.wyysdsa.cn/" target="_blank"><img class="img1" src="{{URL::asset('images/project/project4.png')}}"/></a>
		</div>
	</div>
	<div class="project1" name="project1">
		<div class="project1_right" name="project1_right">
			<a href="http://www.wyysdsa.com/stucontrol/" class="project_a" target="_blank">
			<p style="font-size:22px;letter-spacing:5px;font-weight:bold;">
			查寝系统
			</p></a>
			查寝系统是一个可以在线进行查寝，宿舍保修和发布通知的系统。<br/>
			老师可以在系统中发布通知，查寝。学生可以在系统中登记各类宿舍问题，及时接受老师通知，
			发表各类留言。
		</div>
		<div class="project1_left" name="project1_left">
			<a href="http://www.wyysdsa.com/stucontrol/" target="_blank"><img class="img2" src="{{URL::asset('images/project/project5.png')}}"/></a>
		</div>
	</div>
	<div class="project1" name="project1">
		<div class="project1_right" name="project1_right">
			<a href="http://www.wyysdsa.cn:1965/" class="project_a" target="_blank">
			<p style="font-size:22px;letter-spacing:5px;font-weight:bold;">川理在线</p></a>
			川理在线是一个登录学校教务系统，查询图书馆借阅、校园卡、英语四六级、学生缴费信息的平台。<br>
			学生可在此平台中查询各类信息，平台现已开通安卓客户端和微信小程序。
		</div>
		<div class="project1_left" name="project1_left">
			<a href="http://www.wyysdsa.cn:1965/" target="_blank"><img class="img3" src="{{URL::asset('images/project/project6.png')}}"/></a>
		</div>
	</div>
</div>

<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：李南希
</div>
<!--新改的部分-->
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/project.js')}}"></script>
<script type="text/javascript">
$(function(){
	var project=new project_function();
});
</script>
</body>
</html>