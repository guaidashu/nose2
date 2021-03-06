<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/algorithm.css')}}" />
<title>
算法报名名单
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
		<div class="ca_admin_algorithm">
			<table class="am-table">
			    <thead>
			        <tr>
			            <th>姓名</th>
			            <th>专业</th>
			            <th>更多</th>
			            <th>删除</th>
			        </tr>
			    </thead>
			    <tbody>
			        @foreach($data as $value)

				<tr>
				  <td>{{$id++}}.&nbsp;{{$value->name}}</td>
				  <td>{{$value->subject}}</td>
				  <td><a class="cursor_pointer ca_admin_algorithm_more" data-name="{{$value->name}}" data-subject="{{$value->subject}}" data-date="{{date('Y-m-d',strtotime($value->date))}}" data-phone="{{$value->phone}}" data-email="{{$value->email}}">更多</a></td>
				  <td><a class="cursor_pointer ca_admin_algorithm_delete" data-id="{{$value->id}}">删除</a></td>
				</tr>
					@endforeach

			    </tbody>
			</table>
		</div>
</div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/algorithm.js')}}"></script>
</body>
</html>