<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/code.css')}}" />
<title>
在线代码编译
</title>
</head>
<body>
@include('./../common/navigation')

<div class="ca_code_container">
	<!-- <iframe src="http://sh.wyysdsa.cn/Home/Code/" width="100%" height="100%" style="border:none;"></iframe> -->
	<iframe src="http://ideone.com/" width="100%" height="100%" style="border:none;"></iframe>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/code.js')}}"></script>
<script type="text/javascript">
$(function(){
	var code=new code_function();
});
</script>
</body>
</html>