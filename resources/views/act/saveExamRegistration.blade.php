<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
四六级准考证号备忘
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>四六级准考证号备忘</legend>

		     <div class="am-form-group">
		      <label for="doc-vld-name-2">身份证号码</label>
		      <input type="text" name="name" id="doc-vld-name-2" minlength="2" placeholder="输入你的身份证号" />
		    </div>

		    <div class="am-form-group">
		      <label for="doc-vld-528">准考证号</label>
		      <input type="text" id="doc-vld-528" name="phone" class="js-pattern-mobile"
		             placeholder="请输入准考证号" required/>
		    </div>

		    <div class="am-form-group">
			  <label for="doc-subject-1">姓名</label>
			  <input type="text" id="doc-subject-1" name="subject" class="js-pattern-mobile"
		             placeholder="请输入姓名" required />
			  <span class="am-form-caret"></span>
			</div>

	      </fieldset>
	      <button type="button" class="handle_btn am-btn am-btn-primary am-btn-block">同意声明并保存</button>
	      
	      <div style="margin-top:20px;">
				声明：此网站<b style="color:red;">需用户同意保存本人信息</b>，信息丢失或遗漏计算机技术协会不予承担任何法律责任。如若不同意则酌情使用。同时计算机技术协会承诺不会泄漏任何信息给不相关人士。
		  </div>
	    </form>
	  </div>
	</div>
</div>

<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}" target="_blank">计算机技术协会</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/saveExamRegistration.js')}}"></script>
<script type="text/javascript">
$(function(){
	var saveExamRegistration = new saveExamRegistration_function();
});
</script>
</body>
</html>