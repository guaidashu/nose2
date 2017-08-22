;(function($){
	var findGrade_function = function()
	{
		var self = this;
		this.check=true;
		this.body = $(document.body);
		// this.test();
		this.body.delegate("#doc-subject-1", "focus", function(){
			var zkzh = document.getElementById("doc-vld-email-2").value;
			zkzh = $.trim(zkzh);
			if(!zkzh){
				yy_init("请输入准考证号噢，然后才有验证码");
				return;
			}
			if(!numCheck(zkzh)){
				yy_init("请输入15位的准考证号");
				return;
			}
			if(self.check){
				self.check = false;
				self.getVerify();
			}
		});
		this.body.delegate(".handle_btn_get", "click", function(){
			self.getGradeNum();
		});
		$("form").submit(function(){
			var zkzh = document.getElementById("doc-vld-email-2").value;
			zkzh = $.trim(zkzh);
			if(!zkzh){
				yy_init("请输入准考证号噢，然后才有验证码");
				return false;
			}
			if(!numCheck(zkzh)){
				yy_init("请输入15位的准考证号");
				return false;
			}
		});
		this.body.delegate("#validate", "click", function(){
			if(!self.check){
				self.getVerify();
			}
		});
	};
	findGrade_function.prototype = {
		test:function()
		{
			yy_init("ok");
		},
		getVerify:function()
		{
			var self = this;
			var zkzh = document.getElementById("doc-vld-email-2").value;
			zkzh = $.trim(zkzh);
			if(!zkzh){
				yy_init("请输入准考证号噢，然后才有验证码");
				return;
			}
			$.ajax({
				url:"/act/getVerifyGrade.html",
				type:"GET",
				dataType:"json",
				data:{"zkzh":zkzh},
				success:function(data){
					if(data.text == "ok"){
						document.getElementById("validate").src = "/images/verifyGrade.jpg?r="+(Math.random()*10000000);
					}else{
						yy_init("系统错误");
					}
				},
				error:function(data, status, e){
					yy_init("系统错误");
					// console.log(e);
				}
			});
		},
		getGradeNum:function()
		{
			$.ajax({
                url:"/act/getGradeNumHandle.html",
                type:"POST",
                dataType:"json",
                data:{
                    "id": $("#doc-vld-email-2").val(),
                    "name": $("#doc-vld-name-2").val(),
					"level": document.getElementById("doc-select-1").value
                },
                success: function(data){
                    yy_init(data.text);
                },
				error:function(data, status, e){
					yy_init("获取失败");
				}
            });
		}
	}
	window['findGrade_function'] = findGrade_function;
})(jQuery);


function numCheck(num)
{
	var pattern = /^([0-9]){15}$/;
	if(!pattern.test(num)){
		return false;
	}else{
		return true;
	}
}