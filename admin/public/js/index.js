;(function($){
	var index_function=function()
	{
		var self=this;
		this.body=$(document.body);
		this.autoHeight();
		// test用来设置自适应查看屏幕宽度
		// this.test();
		window.onresize=function()
		{
			self.autoHeight();
		}
	};
	index_function.prototype={
		test:function()
		{
			yy_init($(document).width());
		},
		autoHeight:function()
		{
			// 测试屏幕高度，可视内容的高度
			// yy_init($(document).height());
			$(".nav_side").css("height",$(document).height());
		}
	}
	window['index_function']=index_function;
})(jQuery);
$(function(){
	var index=new index_function();
});