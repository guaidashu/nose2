;(function($){
	var about_function=function()
	{
		var self=this;
		this.body=$(document.body);
		// 判断屏幕宽度
		// this.test();
	};
	about_function.prototype={
		test:function()
		{
			var self=this;
			yy_init($(document).width());
		}
	}
	window['about_function']=about_function;
})(jQuery);