<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
四六级准考证号查询
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" method="POST" action="{{url('act/findGradeResult.html')}}" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>四六级准考证查询</legend>

		    <div class="am-form-group">
		      <label for="doc-vld-email-2">身份证号：</label>
		      <input type="text" name="sfz" id="doc-vld-email-2" placeholder="输入你的身份证号" required/>
		    </div>

		     <div class="am-form-group">
		      <label for="doc-vld-name-2">姓名</label>
		      <input type="text" name="name" id="doc-vld-name-2" minlength="2" placeholder="你的名字是···(至少两个字)" />
		    </div>
		    <div class="am-form-group">
			  <label for="doc-select-1">选择四级或者六级</label>
			  <select name="year" id="doc-select-1">
			    <option value="1">四级</option>
			    <option value="2">六级</option>
			  </select>
			  <span class="am-form-caret"></span>
			</div>
	      </fieldset>
	      <button type="button" class="handle_btn_get am-btn am-btn-primary am-btn-block">提交信息</button>
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