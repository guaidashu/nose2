;(function($){
	var findBookMsg_function = function(type)
	{
		var self = this;
		this.check=true;
		this.body = $(document.body);
		if(type == 1){
			self.getVerify();
		}
		this.body.delegate("#validate", "click", function(){
			self.getVerify();
		});
		this.body.delegate(".handle_btn_book", "click", function(){
			self.login();
		});
		this.body.delegate(".continueGetBook", "click", function(){
			self.continueGetBook($(this));
		});
		this.body.delegate(".exit", "click", function(){
			self.exit();
		});
	};
	findBookMsg_function.prototype = {
		test:function()
		{
			yy_init("ok");
		},
		getVerify:function()
		{
			var self = this;
			$.ajax({
				url:"/act/getBookVerify.html",
				type:"GET",
				dataType:"json",
				data:{},
				success:function(data){
					if(data.text == "ok"){
						document.getElementById("validate").src = "/images/verifyBook.jpg?r="+Math.random()*10000000000;
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
			var username = document.getElementById("doc-vld-xh-2").value;
			username = $.trim(username);
			var password = document.getElementById("doc-vld-name-2").value;
			password = $.trim(password);
			var validate = document.getElementById("doc-subject-1").value;
			validate = $.trim(validate);
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
				url:"/act/findBookMsgLogin.html",
				type:"POST",
				dataType:"json",
				data:{"username":username, "password":password, "validate":validate},
				success:function(data){
					if(data.text == "ok"){
						location.href = "/act/findBookMsgResult.html";
					}else{
						yy_init("密码或者学号或者验证码错误噢");
					}
				},
				error:function(data, status, e){
					console.log(e);
				}
			});
		},
		continueGetBook:function(obj)
		{
			var self = this;
			var readId = obj.attr("data-read");
			var bookId = obj.attr("data-book");
			$.ajax({
				url:"/act/continueGetBook.html",
				type:"POST",
				dataType:"json",
				data:{"readId":readId, "bookId":bookId},
				success:function(data){
					if(data.text == "ok"){
						yy_init("续借成功，请刷新页面查看效果");
					}else{
						yy_init(data.text);
					}
				},
				error:function(data, status, e){
					console.log(e);
				}
			});
		},
		exit:function()
		{
			var self = this;
			$.ajax({
				url:"/act/findBookMsgExit.html",
				type:"GET",
				dataType:"json",
				data:{},
				success:function(data){
					if(data.text == "ok"){
						yy_init("退出成功");
						location.href = "/act/findBookMsg.html";
					}else{
						yy_init("退出失败，请稍后重试");
					}
				},
				error:function(data, status, e){
					console.log(e);
				}
			});
		}
	}
	window['findBookMsg_function'] = findBookMsg_function;
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