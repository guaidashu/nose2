;(function($){
	var crn_function=function()
	{
		var self=this;
		this.body=$(document.body);
		// validateCount 用来存储提交次数， 三次就要弹出验证码
		this.validateCount=0;
		// this.submit用来防止用户在网络不畅的情况下还没有反应的话，多点了就会提交多次
		this.submit=true;
		this.getValidateCount();
		// test()函数用来设置自适应
		// this.test();
		this.body.delegate(".handle_btn", "click", function(){
			if(self.submit){
				self.submit=false;
				self.insert();
			}
		});
		this.body.delegate(".validate_btn", "click", function(){
			self.validateCheck();
		});
	};
	crn_function.prototype={
		test:function()
		{
			yy_init($(document).width());
		},
		// 插入函数 需要判断邮箱，手机号，入学年份和名字是否正确
		insert:function()
		{
			var self=this;
			var name=document.getElementById("doc-vld-name-2").value;
			name=$.trim(name);
			var email=document.getElementById("doc-vld-email-2").value;
			email=$.trim(email);
			var phone=document.getElementById("doc-vld-528").value;
			phone=$.trim(phone);
			var year=document.getElementById("doc-select-1").value;
			year=$.trim(year);
			if(name.length<2 || !email || !phone || !year){
				yy_init("还有内容未完善噢！");
				return;
			}
			if(!emailCheck(email)){
				yy_init("这不是一个正确的邮箱噢");
				return;
			}
			if(!phoneCheck(phone)){
				yy_init("请输入正确的手机号");
				return;
			}
			if(!yearCheck(year)){
				yy_init("请输入正确的入学年份");
				return;
			}
			if(self.validateCount>=3){
				validate_show();
				return;
			}
			$.ajax({
				url:"/crn/handle.html",
				type:"POST",
				dataType:"json",
				data:{"name":name, "email":email, "phone":phone, "year":year},
				success:function(data){
					if(data.text=="ok"){
						yy_init("提交成功");
						self.getValidateCount();
						self.submit=true;
					}else{
						yy_init("提交失败，请稍候重试");
						self.getValidateCount();
						self.submit=true;
					}
				},
				error:function(data,status,e){
					console.log(e);
					self.submit=true;
				}
			});
		},
		getValidateCount:function()
		{
			var self=this;
			$.ajax({
				url:"/getValidateCount.html",
				type:"GET",
				dataType:"json",
				data:{},
				success:function(data){
					self.validateCount=data.text;
				},
				error:function(data,status,e){
					yy_init("系统错误，请稍后再试或者联系我们");
					console.log(e);
				}
			});
		},
		validateCheck:function()
		{
			var self=this;
			var validate=document.getElementById("validate_input").value;
			validate=$.trim(validate);
			if(!validate){
				yy_init("请输入验证码噢");
				return;
			}
			$.ajax({
				url:"/validateCheck.html",
				type:"post",
				dataType:"json",
				data:{"validate":validate},
				success:function(data){
					if(data.text=="ok"){
						yy_init("验证成功，请再次点击提交");
						validateClose();
						self.getValidateCount();
					}else{
						yy_init("验证码错误");
					}
				},
				error:function(data,status,e){
					yy_init("系统错误");
					console.log(e);
				}
			});
		}
	}
	window['crn_function']=crn_function;
})(jQuery);