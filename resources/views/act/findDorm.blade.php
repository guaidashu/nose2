<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
新生寝室号查询
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" method="POST" action="/act/searchDorm.html" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>新生寝室号查询（可以看到室友了噢）</legend>

		     <div class="am-form-group">
		      <label for="doc-vld-name-2">考生号</label>
		      <input type="text" name="num" id="doc-vld-name-2" minlength="2" placeholder="输入你的考生号" />
		    </div>
	      </fieldset>
	      <button type="submit" class="handle_btn am-btn am-btn-primary am-btn-block">提交信息</button>
	    </form>
	  </div>
	</div>
</div>

<div style="width:240px;height:200px;margin:0px auto;">
<img src="{{URL::asset('images/xmlg.jpg')}}" width="100%" height="100%" />
</div>

<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="https://suse.xsdhy.com/" target="_blank">川理在线</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/findDorm.js')}}"></script>
<script type="text/javascript">
$(function(){
	var findDorm = new findDorm_function();
});
</script>
</body>
</html>