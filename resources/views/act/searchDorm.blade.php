<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
新生寝室查询结果
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
		<div class="am-u-md-8 am-u-sm-centered">
		    <form class="am-form" data-am-validator>
			    <fieldset class="am-form-set">
			        <legend style="border-bottom: none;">新生寝室查询结果</legend>
					<ul class="am-list">
					  @if(empty($info))
						  <!-- <li><a href="#">该功能暂未开通噢</a></li> -->
						  <li><a href="#">不存在此考生信息噢，请检查一下有没有输入正确</a></li>
					  @else
						  <li><a href="#">校区：{{$info->xq}}</a></li>
						  <li><a href="#">考生号：{{$info->ksh}}</a></li>
						  <li><a href="#">姓名：{{$info->xm}}</a></li>
						  <li><a href="#">学院：{{$info->xy}}</a></li>
						  <li><a href="#">专业：{{$info->zy}}</a></li>
						  <li><a href="#">学号：{{$info->xh}}</a></li>
						  <li><a href="#">班级：{{$info->bj}}</a></li>
						  <li><a href="#">寝室：{{$info->qs}}</a></li>
						  <li><a href="#">小提示：1-412的意思就是一栋4楼412房号的寝室噢
</a></li>
					  @endif
					</ul>
					@if(!empty($person))
						<legend style="border-bottom: none;">班级人数</legend>
						<ul class="am-list">
							<li><a href="#">男：{{$person['male']}}</a></li>
							<li><a href="#">女：{{$person['female']}}</a></li>
							<li><a href="#">总数：{{$person['all']}}</a></li>
						</ul>
					@endif
					@if(!empty($qs))
						<legend style="border-bottom: none;">你的亲爱的室友们</legend>
						<ul class="am-list">
							@foreach($qs as $k=>$v)
							<li><a href="#">{{$v->xm}}&nbsp;&nbsp;{{$v->bj}}</a></li>
							@endforeach
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
<div style="height:40px;width:100%;"></div>
@include('./../common/bottom')

</body>
</html>