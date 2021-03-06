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
				yy_init("报名已经结束了噢");
				return;
				// self.insert();
			}
		});
		this.body.delegate(".validate_btn", "click", function(){
			self.validateCheck();
		});
		this.body.delegate(".change_redirect_btn", "click", function(){
			self.changeInfo();
		});
		this.body.delegate(".change_password_btn", "click", function(){
			self.changePassword();
		});

		this.body.delegate("#doc-vld-533", "blur", function(){
			if(document.getElementById("doc-vld-532").value != document.getElementById("doc-vld-533").value){
				yy_init("两次密码不一样噢");
				return;
			}
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
			// 获取性别
			var sex = document.getElementById("doc-select-6").value;
			sex = $.trim(sex);
			// 获取学号
			var xh = document.getElementById("doc-vld-530").value;
			xh = $.trim(xh);
			// 获取专业班级
			var zybj = document.getElementById("doc-vld-529").value;
			zybj = $.trim(zybj);
			var content=document.getElementById("doc-vld-ta-2").value;
			content=$.trim(content);
			var arr = ['Office基础', 'C语言二级考试', '网页前端', '网站后端', 'Java程序设计', 'Android开发', '游戏开发', '网络安全', '算法设计', 'C++', '其它'];
			var sexArr = ['男', '女'];
			var major = document.getElementById("doc-select-2").value;
			if(name.length<2 || !email || !phone || !year || !xh || !zybj || !sex){
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
			if(!numCheck(xh)){
				yy_init("请输入11位正确的学号");
				return;
			}
			if(major<0 || major>9){
				yy_init("你娃娃要搞事情");
				return;
			}
			sex = sexArr[sex];
			major = arr[major];
			if(content.length>200){
				yy_init("内容太长了，控制在200字以内噢。");
				return;
			}
			if(self.validateCount>=3){
				validate_show();
				return;
			}
			$(".handle_btn").addClass("am-disabled");
			self.submit=false;
			$.ajax({
				url:"/crn/handle.html",
				type:"POST",
				dataType:"json",
				data:{"name":name, "email":email, "phone":phone, "year":year,"content":content,"major":major,"zybj":zybj,"xh":xh,"sex":sex},
				success:function(data){
					if(data.text=="ok"){
						yy_init("提交成功，请等待邮箱通知结果");
						location.href = "/act/success.html";
					}else if(data.text=="re_phone"){
						yy_init("该手机号已被注册");
					}else if(data.text=="re_email"){
						yy_init("该邮箱已被注册");
					}else{
						yy_init("提交失败，请稍候重试");
					}
					self.getValidateCount();
					$(".handle_btn").removeClass("am-disabled");
					self.submit=true;
				},
				error:function(data,status,e){
					console.log(e);
					self.getValidateCount();
					$(".handle_btn").removeClass("am-disabled");
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
		},
		changeInfo:function()
		{
			var self = this;
			var arr = ['Office基础', 'C语言二级考试', '网页前端', '网站后端', 'Java程序设计', 'Android开发', '游戏开发', '网络安全', '算法设计', 'C++', '其它'];
			var major = document.getElementById("doc-select-2").value;
			major = $.trim(major);
			major = arr[major];
			if(self.validateCount >= 3){
				validate_show();
				return;
			}
			$(".change_redirect_btn").addClass("am-disabled");
			$.ajax({
				url:"/crn/changeInfoHandle.html",
				type:"POST",
				dataType:"json",
				data:{"major":major},
				success:function(data){
					if(data.text == "ok"){
						yy_init("修改成功");
						$(".ca_major").html(major);
					}else{
						yy_init(data.text);
					}
					self.getValidateCount();
					$(".change_redirect_btn").removeClass("am-disabled");
				},
				error:function(data, status, e){
					console.log(e);
					self.getValidateCount();
					$(".change_redirect_btn").removeClass("am-disabled");
				}
			});
		},
		changePassword:function()
		{
			var self = this;
			var phone = document.getElementById("doc-vld-530").value;
			phone = $.trim(phone);
			var password = document.getElementById("doc-vld-531").value;
			password = $.trim(password);
			var newPwd = document.getElementById("doc-vld-532").value;
			newPwd = $.trim(newPwd);
			var rePwd = document.getElementById("doc-vld-533").value;
			rePwd = $.trim(rePwd);
			if(!phone || !password || !newPwd || !rePwd){
				yy_init("请完善信息");
				return;
			}
			if(newPwd != rePwd){
				yy_init("两次密码不一样噢");
				return;
			}
			if(self.validateCount>=3){
				validate_show();
				return;
			}
			$(".change_password_btn").addClass("am-disabled");
			$.ajax({
				url:"/login/changePasswordHandle.html",
				type:"POST",
				dataType:"json",
				data:{"phone":phone, "password":password, "newPwd":newPwd},
				success:function(data){
					if(data.text == "ok"){
						yy_init("修改成功");
						document.getElementById("doc-vld-530").value = "";
						document.getElementById("doc-vld-531").value = "";
						document.getElementById("doc-vld-532").value = "";
						document.getElementById("doc-vld-533").value = "";
					}else if(data.text == "error_password"){
						yy_init("密码错误");
					}else if(data.text == "error_user"){
						yy_init("不存在此用户");
					}else{
						yy_init("未知错误");
					}
					$(".change_password_btn").removeClass("am-disabled");
				},
				error:function(data, status, e){
					console.log(e);
					$(".change_password_btn").removeClass("am-disabled");
				}
			});
			self.getValidateCount();
		}
	}
	window['crn_function']=crn_function;
})(jQuery);

function numCheck(num)
{
	var pattern = /^([0-9]){11}$/;
	if(!pattern.test(num)){
		return false;
	}else{
		return true;
	}
}