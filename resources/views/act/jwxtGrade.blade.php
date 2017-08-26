<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
成绩查询结果
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	      @if(!empty($info))
		      <legend>{{$info[0][0]}}学年第{{$info[0][1]}}学期成绩查询结果</legend>
	      @else
		      <legend>成绩查询结果</legend>
	      @endif 
		        <ul class="am-list">
			        <a href="#" class="">{{$username}}</a>&nbsp;<a href="#" class="exitGrade">退出</a>
		        </ul>
          @if(!empty($info))
		        <section data-am-widget="accordion" class="am-accordion am-accordion-default" data-am-accordion='{ "multiple": true }'>
		        @foreach($info as $k=>$v)
		            <dl class="am-accordion-item">
		            @if($v[11] < 60 && is_numeric($v[11]))
				        <dt class="am-accordion-title" style="color:red;">
					        {{$v[3]}}：{{$v[11]}}
		                </dt>
	                @else
		                <dt class="am-accordion-title">
					        {{$v[3]}}：{{$v[11]}}
		                </dt>
	                @endif
				        <dd class="am-accordion-bd am-collapse ">
				          <div class="am-accordion-content">
					          学分：{{$v[6]}}<br>
					          平时成绩：{{$v[7]}}<br>
					          期中成绩：{{$v[8]}}<br>
					          卷面成绩：{{$v[9]}}<br>
				          </div>
				        </dd>
			        </dl>
		        @endforeach
				</section>
			@else
				<ul class="am-list">
					<li><a href="#">暂时没有成绩信息噢。</a></li>
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

<script type="text/javascript" src="{{URL::asset('js/grade.js')}}"></script>
<script type="text/javascript">
$(function(){
	var grade=new grade_function(2);
});
</script>
</body>
</html>