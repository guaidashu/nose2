<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
新生班级查询结果
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
					<ul class="am-list">
					  <li style="border-top:none;"><a href="#">姓名：{{$info['name']}}</a></li>
					  <li><a href="#">入学年份：{{$info['year']}}</a></li>
					  <li><a href="#">院系：{{$info['further']}}</a></li>
					  <li><a href="#">专业：{{$info['major']}}</a></li>
					  <li><a href="#">班级：{{$info['class']}}</a></li>
					  <li><a href="#">学号：{{$info['classNumber']}}</a></li>
					</ul>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}">计算机技术协会</a>
</div>
<div style="height:40px;width:100%;"></div>
@include('./../common/bottom')

</body>
</html>