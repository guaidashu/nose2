;(function($){
	var confirmPage_function = function()
	{
		var self = this;
		this.check = true;
		this.body = $(document.body);
		// this.test();
		this.body.delegate(".handle_btn", "click", function(){
			self.searchInfo();
		});
		this.body.delegate(".handle_btn_confirm", "click", function(){
			self.change($(this));
		});
		document.getElementById("searchName").focus();
		this.body.delegate("#searchName", "focus", function(){
			self.check = true;
		});
		this.body.delegate("#searchName", "blur", function(){
			self.check = false;
		});
		$(document).keydown(function(e){
			if(e.keyCode == 13 && self.check){
				self.searchInfo();
			}
		});
	};
	confirmPage_function.prototype = {
		test:function()
		{
			yy_init($(document).width());
		},
		searchInfo:function()
		{
			var self = this;
			var name = document.getElementById("searchName").value;
			name = $.trim(name);
			$.ajax({
				url:"/crn/confirmGetInfo.html",
				type:"POST",
				dataType:"json",
				data:{"name":name},
				success:function(data){
					if(data.id != 0){
						var str = '<li style="background-color:transparent;"><a href="#">姓名：'+data.text.name+'</a></li>'+
								  '<li style="background-color:transparent;"><a href="#">电话：'+data.text.phone+'</a></li>'+
								  '<li style="background-color:transparent;"><a href="#">邮箱：'+data.text.email+'</a></li>'+
								  '<li style="background-color:transparent;"><a href="#">学习方向：'+data.text.major+'</a></li>'+
								  '<li style="background-color:transparent;"><a href="#">专业班级：'+data.text.zybj+'</a></li>'+
								  '<li style="background-color:transparent;"><a href="#">性别：'+data.text.sex+'</a></li>';
						if(data.text.qq && data.text.allow==1){
							str = str + '<li style="background-color:transparent;"><a href="#">已确认入会</a></li>';
						}else if(data.text.qq){
							str = str + '<li style="background-color:transparent;"><a href="#">你还没有缴费并进行确认噢</a></li>';
						}else{
							$(".qq").css("display", "block");
							$(".fie_show").html('<button data-id="'+data.text.id+'" type="button" class="handle_btn_confirm am-btn am-btn-primary am-btn-block">确认提交</button>');
						}
						$(".info_show").html(str);
					}else{
						$(".info_show").html('<li style="background-color:transparent;"><a href="#">'+data.text+'</a></li>');
						$(".handle_btn_confirm").remove();
						$(".qq").css("display", "none");
					}
				},
				error:function(data, status, e){
					console.log(e);
				}
			});
		},
		change:function(obj)
		{
			var self = this;
			var id = obj.attr("data-id");
			var qq = document.getElementById("qq").value;
			qq = $.trim(qq);
			if(!qq){
				yy_init("请输入qq号");
				return;
			}
			$.ajax({
				url:"/crn/confirmChange.html",
				type:"POST",
				dataType:"json",
				data:{"id":id, "qq":qq},
				success:function(data){
					if(data.text == "ok"){
						yy_init("确认成功");
						document.getElementById("qq").value = "";
					}else{
						yy_init("已经提交过了");
					}
				},
				error:function(data, status, e){
					console.log(e);
				}
			});
		}
	}
	window['confirmPage_function'] = confirmPage_function;
})(jQuery);