<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/algorithm.css')}}" />
<title>
入会确认
</title>
</head>
<body>
<!--[if lte IE 9 ]>
<div class="am-alert am-alert-danger ie-warning" data-am-alert>
  <button type="button" class="am-close">&times;</button>
  <div class="am-container">
    365 安全卫士提醒：你的浏览器太古董了，妹子无爱，<a
    href="http://browsehappy.com/" target="_blank">速速点击换一个</a>！</div></div>
<![endif]-->
@include('./../common/navigation')

<div class="admin_index_container">
		<div class="ca_admin_container">
			<div class="searchName">
				<div class="am-g" style="margin-top:20px;">
				  <div class="am-u-lg-12">
				    <div class="am-input-group">
				      <span class="am-input-group-btn">
				        <button class="handle_btn am-btn am-btn-default" type="button"><span class="am-icon-search"></span> </button>
				      </span>
				      <input type="text" class="am-form-field" placeholder="请输入学号" id="searchName">
				    </div>
				  </div>
				</div>
			</div>
		</div>


		<div class="am-g" style="margin-top:30px;">
		  <div class="am-u-md-8 am-u-sm-centered">
		    <form class="am-form" data-am-validator>
		      <fieldset class="am-form-set">
				<ul class="am-list info_show">
					
				</ul>
				<div class="am-form-group qq" style="display:none;">
			      <label for="qq">qq号：</label>
			      <input type="text" name="xh" id="qq" placeholder="输入你的qq号" required/>
			    </div>
				<div class="fie_show" style="width:100%;">

				</div>
		      </fieldset>
		    </form>
		  </div>
		</div>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/confirmPage.js')}}"></script>
<script type="text/javascript">
$(function(){
	var confirmPage = new confirmPage_function();
});
</script>
</body>
</html>