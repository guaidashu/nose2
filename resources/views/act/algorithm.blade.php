<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
算法入门报名
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

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>算法入门报名</legend>

		    <div class="am-form-group">
		      <label for="doc-vld-email-2">邮箱</label>
		      <input type="email" name="email" id="doc-vld-email-2" placeholder="请填写正确，我们会有一些资料和通知发送" required/>
		    </div>

		     <div class="am-form-group">
		      <label for="doc-vld-name-2">姓名</label>
		      <input type="text" name="name" id="doc-vld-name-2" minlength="2" placeholder="你的名字是···(至少两个字)" />
		    </div>

		    <div class="am-form-group">
		      <label for="doc-vld-528">手机号</label>
		      <input type="text" id="doc-vld-528" name="phone" class="js-pattern-mobile"
		             placeholder="输入手机号" required/>
		    </div>

		    <div class="am-form-group">
			  <label for="doc-subject-1">专业</label>
			  <input type="text" id="doc-subject-1" name="subject" class="js-pattern-mobile"
		             placeholder="输入你的专业名" required />
			  <span class="am-form-caret"></span>
			</div>
	      </fieldset>
	      <button type="button" class="handle_btn am-btn am-btn-primary am-btn-block">提交信息</button>
	    </form>
	  </div>
	</div>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/algorithm.js')}}"></script>
<script type="text/javascript">
$(function(){
	var algorithm=new algorithm_function();
})
</script>
</body>
</html>