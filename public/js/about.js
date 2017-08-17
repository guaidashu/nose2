;(function($){
	var about_function=function()
	{
		var self=this;
		this.body=$(document.body);
		// 判断屏幕宽度
		// this.test();
		this.carousel_init();
		window.onresize = function(){
			// self.carousel_init();
		}
	};
	about_function.prototype={
		test:function()
		{
			var self=this;
			yy_init($(document).width());
		},
		// 轮播器自适应宽度高度
		carousel_init:function(){
			var self = this;
			// 获取屏幕可视宽度
			var screenWidth = parseInt($(document).width());
			// 获取屏幕可视高度
			var lookHeight = parseInt(window.innerHeight);
			// 首先让轮播器容器高度宽度自适应
			$(".ca_carousel_container").css({
				"height" : lookHeight + "px"
			});
			$(".ca_carousel").css("width",screenWidth*3+"px");
		}
	}
	window['about_function']=about_function;
})(jQuery);