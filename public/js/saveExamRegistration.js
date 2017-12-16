;(function($){
	var saveExamRegistration_function = function()
	{
		var self = this;
		this.body = $(document.body);
		// 测试页面宽度 ，用于设计自适应
		// this.test();
		this.body.delegate(".handle_btn", "click", function(){
			self.save();
		});
	};
	saveExamRegistration_function.prototype = {
		test:function()
		{
			var self = this;
			yy_init($(document).width());
		},
		save:function()
		{
			var self=this;
			var ID = document.getElementById("doc-vld-name-2").value;
			ID = $.trim(ID);
			var registration = document.getElementById("doc-vld-528").value;
			registration = $.trim(registration);
			var name = document.getElementById("doc-subject-1").value;
			name = $.trim(name);
			if(!ID || !name || !registration){
				yy_init("有内容未完善");
				return;
			}
			$.ajax({
				url:"/act/saveExamRegistration.html",
				type:"POST",
				dataType:"json",
				data:{"ID":ID,"registration":registration,"name":name},
				success:function(data){
					if(data.text == "ok"){
						yy_init("保存成功");
					}else if(data.text == "exists"){
						yy_init("该身份证号已经被保存，请联系管理员或者等待修改系统上线");
					}else{
						yy_init("保存失败，请稍后再试");
					}
				},
				error:function(data, status, e){
					yy_init("系统错误");
					console.log(e);
				}
			});
		}
	}
	window['saveExamRegistration_function'] = saveExamRegistration_function;
})(jQuery);