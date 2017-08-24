<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
图书借阅信息
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>图书借阅信息</legend>
	        <a href="#" class="">{{$username}}</a>&nbsp;<a href="#" class="exit">退出</a>
	        @if(!empty($info) && !empty($readId) && !empty($bookId))
		        <section data-am-widget="accordion" class="am-accordion am-accordion-default" data-am-accordion='{ "multiple": true }'>
		        @foreach($info as $key => $value)
		            <dl class="am-accordion-item">
				        <dt class="am-accordion-title">
					        {{$value[0]}}
		                </dt>
				        <dd class="am-accordion-bd am-collapse ">
				          <div class="am-accordion-content">
					          出版者：{{$value[1]}}<br>
					          外借时间：{{$value[2]}}<br>
					          应归还时间：{{$value[3]}}<br>
					          已续借次数：{{$value[4]}}<br>
					          <a href="#" class="continueGetBook" data-read="{{$readId}}" data-book="{{$bookId[$key]}}">续借</a>
				          </div>
				        </dd>
			        </dl>
				@endforeach
				</section>
			@else
				<ul class="am-list">
					<li><a href="#">暂时没有借阅图书噢。</a></li>
				</ul>
			@endif
	      </fieldset>
	    </form>
	  </div>
	</div>
</div>
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="https://suse.xsdhy.com/" target="_blank">川理在线</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/findBookMsg.js')}}"></script>
<script type="text/javascript">
$(function(){
	var findBookMsg=new findBookMsg_function(2);
});
</script>
</body>
</html>