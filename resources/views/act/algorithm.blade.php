<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

<link rel="stylesheet" type="text/css" href="{{URL::asset('css/crn.css')}}" />
<title>
算法入门报名
</title>
</head>
<body>
@include('./../common/navigation')

<div class="crn_container">
	<div class="am-g">
	  <div class="am-u-md-8 am-u-sm-centered">
	    <form class="am-form" data-am-validator>
	      <fieldset class="am-form-set">
	        <legend>算法入门报名</legend>

		    <div class="am-form-group">
		      <label for="doc-vld-email-2">邮箱</label>
		      <input type="email" name="email" id="doc-vld-email-2" placeholder="请填写正确，我们会有一些资料和通知发送" required/>
		    </div>

		     <div class="am-form-group">
		      <label for="doc-vld-name-2">姓名</label>
		      <input type="text" name="name" id="doc-vld-name-2" minlength="2" placeholder="你的名字是···(至少两个字)" />
		    </div>

		    <div class="am-form-group">
		      <label for="doc-vld-528">手机号</label>
		      <input type="text" id="doc-vld-528" name="phone" class="js-pattern-mobile"
		             placeholder="输入手机号" required/>
		    </div>

		    <div class="am-form-group">
			  <label for="doc-subject-1">专业</label>
			  <input type="text" id="doc-subject-1" name="subject" class="js-pattern-mobile"
		             placeholder="输入你的专业名（最多四个字噢）" required />
			  <span class="am-form-caret"></span>
			</div>
	      </fieldset>
	      <button type="button" class="handle_btn am-btn am-btn-primary am-btn-block">提交信息</button>
	    </form>
	  </div>
	</div>
</div>
<!-- 注册声明 -->
<div class="login_statement">
	<div class="login_statement_container">
		<div class="login_statement_remind">
		&nbsp;报名需知
		</div>
		<div class="login_statement_close">
		</div>
		<div class="login_statement_content">
			*1.&nbsp;注意：注册由于同时会给大家发邮件，所以请耐心等待。<br />若是没有收到邮件，可能是被拦截了（QQ邮箱我也很无奈），请在垃圾邮箱查看<br /><br />
			2.&nbsp;目的<br/>
			本次编程基础入门和算法入门培训，第一是为大家做好编程兴趣的培养，此外有一些小小的私心就是希望为协会培养一批新一届的扛把子。<br /><br />
			*3.&nbsp;原因<br />
			除此之外，学校方面，因为计算机学院从此都是大一大二大三一起的了，所以学院方面想要培养一批算法种子团队。<br />
			争取在每年的各种算法比赛中为校为学院争光。<br /><br />
			*4.&nbsp;目标<br />
			在协会与算法比赛负责的老师沟通下，特此从新生开始抓起。为大家开展此培训。<br />
			希望大家积极参与，提高自己，也为未来打下良好的基础。<br /><br />
			5.&nbsp;报名方式<br />
			本次在计算机协会官网也就是这个页面进行报名登记。<br />
			报名成功的话会收到一封邮件通知。另外稍后还可能发送一些文件和资料到每个人的邮箱。<br />所以请填写正确可行的邮箱地址，同时在收到邮件后信任此发件人，否则后面可能会收不到相应文件和图片。<br /><br/>
			*6.&nbsp;开课时间<br />
			将会于2017/8/15日晚8点第一次进行开课，因为条件限制，就在QQ群进行。<br/ >
			群号将会于第一次通知邮件一起发送给大家。请注意查收。
		</div>
		<div class="login_statement_btn">
		&nbsp;确定
		</div>
	</div>
</div>
<div class="login_statement_envelop">
</div>
<div id="bottom_author" style="width:100%;min-height:50px;line-height:50px;text-align:center;color:#333;font-size:15px;">
	技术支持：<a href="{{url('index/index.html')}}">计算机技术协会</a>
</div>
<div style="width:100%;height:50px;"></div>
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/algorithm.js')}}"></script>
<script type="text/javascript">
$(function(){
	var algorithm=new algorithm_function();
})
</script>
</body>
</html>