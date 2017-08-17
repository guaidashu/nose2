<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
新生班级查询
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>新生班级查询</legend>

		     <div class="am-form-group">
		      <label for="doc-vld-name-2">身份证号码</label>
		      <input type="text" name="name" id="doc-vld-name-2" minlength="2" placeholder="你的名字是···(至少两个字)" />
		    </div>

		    <div class="am-form-group">
		      <label for="doc-vld-528">密码</label>
		      <input type="password" id="doc-vld-528" name="phone" class="js-pattern-mobile"
		             placeholder="默认是身份证后六位数" required/>
		    </div>

		    <div class="am-form-group">
			  <label for="doc-subject-1">验证码</label>
			  <input type="text" id="doc-subject-1" name="subject" class="js-pattern-mobile"
		             placeholder="请输入验证码" required />
			  <span class="am-form-caret"></span>
			</div>
			<div class="am-form-group">
			  <img id="validate" style="cursor: pointer;" src="" width="80px" />
			</div>
	      </fieldset>
	      <button type="button" class="handle_btn am-btn am-btn-primary am-btn-block">提交信息</button>
	    </form>
	  </div>
	</div>
</div>

<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}">计算机技术协会</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/findClass.js')}}"></script>
<script type="text/javascript">
$(function(){
	var findClass = new findClass_function();
});
</script>
</body>
</html>