<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
提交QQ号
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="searchName">
		<div class="am-g" style="margin-top:20px;">
		  <div class="am-u-lg-12">
		    <div class="am-input-group">
		      <span class="am-input-group-btn">
		        <button class="handle_btn am-btn am-btn-default" type="button"><span class="am-icon-search"></span> </button>
		      </span>
		      <input type="text" class="am-form-field" id="searchName" placeholder="请输入你的学号噢" />
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
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}">计算机技术协会</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/confirmPage.js')}}"></script>
<script type="text/javascript">
$(function(){
	var confirmPage=new confirmPage_function();
})
</script>
</body>
</html>



