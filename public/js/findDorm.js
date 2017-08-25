;(function($){
	var findDorm_function = function()
	{
		var self = this;
		this.body = $(document.body);
		// 测试页面宽度 ，用于设计自适应
		// this.test();
		// this.body.delegate(".handle_btn", "click", function(){
		// 	self.searchDorm();
		// });
	};
	findDorm_function.prototype = {
		test:function()
		{
			var self = this;
			yy_init($(document).width());
		},
		searchDorm:function()
		{
			var self = this;
			var num = document.getElementById("doc-vld-name-2").value;
			num = $.trim(num);
			if(!num){
				yy_init("请填写考生号噢！");
				return;
			}
		}
	}
	window['findDorm_function'] = findDorm_function;
})(jQuery);