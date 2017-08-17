<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/about.css')}}" />
<title>
协会招新
</title>
</head>
<body>
@include('./../common/navigation')

<div class="ca_about_container">
	<div class="ca_carousel_container">
		<div class="ca_carousel">
			<div class="ca_carousel_img">
				<img />
			</div>
		</div>
	</div>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/about.js')}}"></script>
<script type="text/javascript">
$(function(){
	var about=new about_function();
})
</script>
</body>
</html>