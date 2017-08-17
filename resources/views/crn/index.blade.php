<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
协会招新
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>协会招新</legend>

		    <div class="am-form-group">
		      <label for="doc-vld-email-2">邮箱：</label>
		      <input type="email" name="email" id="doc-vld-email-2" placeholder="输入邮箱" required/>
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
			  <label for="doc-select-1">入学年份</label>
			  <select name="year" id="doc-select-1">
			    <option value="2017">2017</option>
			    <option value="2016">2016</option>
			    <option value="2015">2015</option>
			  </select>
			  <span class="am-form-caret"></span>
			</div>

			<div class="am-form-group">
		      <label for="doc-vld-ta-2">简单介绍一下你自己</label>
		      <textarea id="doc-vld-ta-2" minlength="0" placeholder="随便说点什么···"></textarea>
		    </div>
	      </fieldset>
	      <button type="button" class="handle_btn am-btn am-btn-primary am-btn-block">提交信息</button>
	    </form>
	  </div>
	</div>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/crn.js')}}"></script>
<script type="text/javascript">
$(function(){
	var crn=new crn_function();
})
</script>
</body>
</html>