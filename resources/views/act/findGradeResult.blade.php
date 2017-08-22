<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
四六级成绩查询结果
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>四六级成绩查询结果</legend>
	        <ul class="am-list">
		        @if(!empty($result))
			        <li><a href="#">姓名：{{$result[1]}}</a></li>
			        <li><a href="#">准考证号：{{$result[0]}}</a></li>
			        <li><a href="#">总分：{{$result[3]}}</a></li>
			        <li><a href="#">听力：{{$result[5]}}</a></li>
			        <li><a href="#">阅读：{{$result[6]}}</a></li>
			        <li><a href="#">写作和翻译：{{$result[7]}}</a></li>
			        <li><a href="#">怪大叔的小提示：425分就过了噢</a></li>
			    @else
			        <li><a href="#">没有此考生信息或者验证码和账户信息错误噢</a></li>
		        @endif
	        </ul>
	      </fieldset>
	      <button type="button" class="handle_btn am-btn am-btn-primary am-btn-block">返回</button>
	    </form>
	  </div>
	</div>
</div>
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="https://suse.xsdhy.com/" target="_blank">川理在线</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript">
$(document).ready(function(){
	$(".handle_btn").click(function(){
		location.href="{{url('act/findGrade.html')}}";
	});
});
</script>
</body>
</html>