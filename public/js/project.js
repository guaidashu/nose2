;(function($){
	var project_function=function()
	{
		var self=this;
		this.body=$(document.body);
		// test用来弹出屏幕宽度用于自适应开发
		this.test();

		this.projectContainerAuto();
		window.onresize=function(){
			self.projectContainerAuto();
		}
	};
	project_function.prototype={
		test:function()
		{
			var self=this;
			yy_init($(document).width());
		},
		projectContainerAuto:function()
		{
			var self=this;
			var screenWidth=parseInt($(document).width());
			var height=parseInt($(".project1_right").height());
			$(".project1").css("height",height+45+"px");
		}
	}
	window['project_function']=project_function;
})(jQuery);