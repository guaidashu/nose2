<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
四六级成绩查询
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" method="POST" action="{{url('act/findGradeResult.html')}}" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>四六级成绩查询</legend>

		    <div class="am-form-group">
		      <label for="doc-vld-email-2">准考证号：</label>
		      <input type="text" name="zkz" id="doc-vld-email-2" placeholder="输入你的准考证号" required/>
		    </div>

		     <div class="am-form-group">
		      <label for="doc-vld-name-2">姓名</label>
		      <input type="text" name="name" id="doc-vld-name-2" minlength="2" placeholder="你的名字是···(至少两个字)" />
		    </div>

		    <div class="am-form-group">
			  <label for="doc-subject-1">验证码</label>
			  <input type="text" id="doc-subject-1" name="validate" class="js-pattern-mobile"
		             placeholder="请输入验证码" required />
			  <span class="am-form-caret"></span>
			</div>

			<div class="am-form-group">
			  <img id="validate" style="cursor: pointer;" src="" width="80px" />
			</div>
	      </fieldset>
	      <button type="submit" class="handle_btn am-btn am-btn-primary am-btn-block">提交信息</button>
	    </form>
	  </div>
	</div>
</div>
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="https://suse.xsdhy.com/" target="_blank">川理在线</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/findGrade.js')}}"></script>
<script type="text/javascript">
$(function(){
	var findGrade=new findGrade_function();
})
</script>
</body>
</html>