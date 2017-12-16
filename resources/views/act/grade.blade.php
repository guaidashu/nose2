<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
成绩查询
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>成绩查询</legend>
	        <div class="am-form-group">
			  <label for="doc-select-2">选择学年</label>
			  <select name="year" id="doc-select-2">
			  	  <option value="2017-2018">2017-2018</option>
				  <option value="2016-2017">2016-2017</option>
				  <option value="2015-2016">2015-2016</option>
				  <option value="2014-2015">2014-2015</option>
				  <option value="2013-2014">2013-2014</option>
				  <option value="2012-2013">2012-2013</option>
				  <option value="2011-2012">2011-2012</option>
				  <option value="2010-2011">2010-2011</option>
				  <option value="2009-2010">2009-2010</option>
				  <option value="2008-2009">2008-2009</option>
			  </select>
			  <span class="am-form-caret"></span>
			</div>

			<div class="am-form-group">
			  <label for="doc-select-3">选择学期</label>
			  <select name="year" id="doc-select-3">
			  	  <option value="1">1</option>
				  <option value="2">2</option>
			  </select>
			  <span class="am-form-caret"></span>
			</div>

		    <div class="am-form-group">
		      <label for="doc-vld-xh-2">学号：</label>
		      <input type="text" name="xh" id="doc-vld-xh-2" placeholder="输入你的学号" required/>
		    </div>

		     <div class="am-form-group">
		      <label for="doc-vld-name-2">密码</label>
		      <input type="password" name="password" id="doc-vld-name-2" minlength="2" placeholder="输入你的教务系统密码噢" />
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
	      <button type="button" class="handle_btn_book am-btn am-btn-primary am-btn-block">提交信息</button>
	    </form>
	  </div>
	</div>
</div>
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="https://suse.xsdhy.com/" target="_blank">川理在线</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/grade.js')}}"></script>
<script type="text/javascript">
$(function(){
	var grade=new grade_function(1);
});
</script>
</body>
</html>