<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
修改学习方向
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>修改学习方向</legend>
	        <div class="am-form-group">
		      <label for="doc-vld-530">帐号</label>
		      <input type="text" id="doc-vld-530" name="xh" class="js-pattern-mobile"
		             placeholder="输入学号，若是不知道，可在此网站进行查询" required/>
		    </div>
		    <div class="am-form-group">
		      <label for="doc-vld-531">密码</label>
		      <input type="password" id="doc-vld-531" name="password" class="js-pattern-mobile"
		             placeholder="输入学号，若是不知道，可在此网站进行查询" required/>
		    </div>
	        <div class="am-form-group">
			  <label for="doc-select-2">学习方向</label>
			  <select name="year" id="doc-select-2">
				<option value="0">Office基础</option>
				<option value="1">C语言二级考试</option>
			    <option value="2">网页前端</option>
			    <option value="3">网站后端</option>
			    <option value="4">Java程序设计</option>
			    <option value="5">Android开发</option>
			    <option value="6">游戏开发</option>
			    <option value="7">网络安全</option>
			    <option value="8">算法设计</option>
			    <option value="9">其它</option>
			  </select>
			  <span class="am-form-caret"></span>
			</div>
	      </fieldset>
	      <button type="button" class="change_redirect_btn am-btn am-btn-primary am-btn-block">确认修改</button>
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