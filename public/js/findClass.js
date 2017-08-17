;(function($){
	var findClass_function = function()
	{
		var self = this;
		this.body = $(document.body);
		this.getVerify();
		// 测试页面宽度 ，用于设计自适应
		// this.test();
		this.body.delegate(".handle_btn", "click", function(){
			self.login();
		});
		this.body.delegate("#validate", "click", function(){
			self.getVerify();
		});
	};
	findClass_function.prototype = {
		test:function()
		{
			var self = this;
			yy_init($(document).width());
		},
		getVerify:function()
		{
			var self=this;
			$.ajax({
				url:"/act/getVerify.html",
				type:"GET",
				dataType:"json",
				data:{},
				success:function(data){
					if(data.text == "ok"){
						document.getElementById("validate").src="/images/verify.jpg?r="+Math.random()*10000000;
					}else{
						yy_init("教务系统正繁忙，请稍后再试");
					}
				},
				error:function(data, status, e){
					yy_init("系统错误");
					console.log(e);
				}
			});
		},
		login:function()
		{
			var self=this;
			var username=document.getElementById("doc-vld-name-2").value;
			username=$.trim(username);
			var password=document.getElementById("doc-vld-528").value;
			password=$.trim(password);
			var validate=document.getElementById("doc-subject-1").value;
			validate=$.trim(validate);
			if(!username || !validate){
				yy_init("有内容未完善");
				return;
			}
			if(!password){
				password = username.substring(12,18);
			}
			$.ajax({
				url:"/act/login.html",
				type:"POST",
				dataType:"json",
				data:{"username":username,"password":password,"validate":validate},
				success:function(data){
					if(data.text == "ok"){
						location.href="/act/getInfo.html";
					}else{
						yy_init("信息错误，请检查帐号或者密码或者验证码");
						self.getVerify();
					}
				},
				error:function(data, status, e){
					yy_init("系统错误");
					console.log(e);
				}
			});
		}
	}
	window['findClass_function'] = findClass_function;
})(jQuery);