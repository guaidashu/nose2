<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
修改密码
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>修改密码</legend>
	        <div class="am-form-group">
		      <label for="doc-vld-530">手机号</label>
		      <input type="text" id="doc-vld-530" name="xh" class="js-pattern-mobile"
		             placeholder="输入手机号" required/>
		    </div>
		    <div class="am-form-group">
		      <label for="doc-vld-531">旧密码</label>
		      <input type="password" id="doc-vld-531" name="password" class="js-pattern-mobile"
		             placeholder="输入密码,默认为123" required/>
		    </div>
		    <div class="am-form-group">
		      <label for="doc-vld-532">新密码</label>
		      <input type="password" id="doc-vld-532" name="password" class="js-pattern-mobile"
		             placeholder="输入新密码" required/>
		    </div>
		    <div class="am-form-group">
		      <label for="doc-vld-533">确认密码</label>
		      <input type="password" id="doc-vld-533" name="password" class="js-pattern-mobile"
		             placeholder="确认密码密码" required/>
		    </div>
	      </fieldset>
	      <button type="button" class="change_password_btn am-btn am-btn-primary am-btn-block">确认修改</button>
	    </form>
	  </div>
	</div>
</div>
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}">计算机技术协会</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/crn.js')}}"></script>
<script type="text/javascript">
$(function(){
	var crn=new crn_function();
})
</script>
</body>
</html>