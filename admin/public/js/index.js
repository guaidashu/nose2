;(function($){
	var index_function=function()
	{
		var self=this;
		this.body=$(document.body);
		this.heightCheck=0;
		this.autoNavHeight();
		this.autoContainerWidth();
		this.autoWelcomeHeight();
		// test用来设置自适应查看屏幕宽度
		// this.test();
		window.onresize=function()
		{
			self.autoNavHeight();
			self.autoContainerWidth();
			self.autoWelcomeHeight();
		}
	};
	index_function.prototype={
		test:function()
		{
			yy_init($(document).width());
		},
		// 侧边导航栏高度自适应函数
		autoNavHeight:function()
		{
			// 测试屏幕高度，可视内容的高度
			// yy_init($(document).height());
			$(".nav_side").css("height",$(document).height());
		},
		// 主容器宽度自适应函数
		autoContainerWidth:function()
		{
			var self=this;
			var screenWidth=parseInt($(document).width());
			if(screenWidth>680){
				$(".admin_index_container").css("width",screenWidth-240+"px");
			}else{
				$(".admin_index_container").css("width","100%");
			}
		},
		//主页欢迎窗口高度自适应
		autoWelcomeHeight:function()
		{
			var self=this;
			var screenHeight=window.innerHeight;
			if(self.heightCheck<screenHeight){
				$(".admin_index_introduce").css("height",screenHeight);
				self.heightCheck=screenHeight;
			}
		}
	}
	window['index_function']=index_function;
})(jQuery);
$(function(){
	var index=new index_function();
});