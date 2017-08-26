;(function($){
	var grade_function = function(type)
	{
		var self = this;
		this.check=true;
		this.body = $(document.body);
		if(type == 1){
			this.getVerify();
		}
		this.body.delegate("#validate", "click", function(){
			self.getVerify();
		});
		this.body.delegate(".handle_btn_book", "click", function(){
			self.login();
		});
		this.body.delegate(".exitGrade", "click", function(){
			self.gradeExit();
		});
	};
	grade_function.prototype = {
		test:function()
		{
			yy_init("ok");
		},
		getVerify:function()
		{
			var self = this;
			$.ajax({
				url:"/act/getVerifyGradeQM.html",
				type:"GET",
				dataType:"json",
				data:{},
				success:function(data){
					if(data.text == "ok"){
						document.getElementById("validate").src = "/images/verifyGradeQM.jpg?r="+Math.random()*10000000000;
					}else{
						yy_init(data.text);
					}
				},
				error:function(data, status, e){
					console.log(e);
				}
			});
		},
		login:function()
		{
			var self = this;
			// 获取学期
			var item = document.getElementById("doc-select-3").value;
			item = $.trim(item);
			// 获取学年
			var year = document.getElementById("doc-select-2").value;
			year = $.trim(year);
			var username = document.getElementById("doc-vld-xh-2").value;
			username = $.trim(username);
			var password = document.getElementById("doc-vld-name-2").value;
			password = $.trim(password);
			var validate = document.getElementById("doc-subject-1").value;
			validate = $.trim(validate);
			if(!item){
				yy_init("你娃娃怕是要搞事情噢");
				return;
			}
			if(!year){
				yy_init("你娃娃怕是要搞事情噢");
			}
			if(!username){
				yy_init("请输入学号");
				return;
			}
			if(!password){
				yy_init("请输入密码");
				return;
			}
			if(!validate){
				yy_init("请输入验证码");
				return;
			}
			if(!numCheck(username)){
				yy_init("请输入11位的正确的学号");
				return;
			}
			$.ajax({
				url:"/act/jwxtLogin.html",
				type:"POST",
				dataType:"json",
				data:{"username":username, "password":password, "validate":validate, "item":item, "year":year},
				success:function(data){
					if(data.text == "ok"){
						location.href = "/act/jwxtGrade.html";
					}else{
						yy_init(data.text);
						self.getVerify();
					}
				},
				error:function(data, status, e){
					console.log(e);
					self.getVerify();
				}
			});
		},
		gradeExit:function()
		{
			var self = this;
			$.ajax({
				url:"/act/gradeExit.html",
				type:"GET",
				dataType:"json",
				data:{},
				success:function(data){
					if(data.text == "ok"){
						location.href = "/act/grade.html";
					}else{
						yy_init("退出失败");
					}
				},
				error:function(data, status, e){
					console.log(e);
				}
			});
		}
	}
	window['grade_function'] = grade_function;
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