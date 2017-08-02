;(function($){
	var code_function=function()
	{
		var self=this;
		this.body=$(document.body);
		this.heightCheck=0;
		this.caCodeContainerAuto();
		window.onresize=function(){
			self.caCodeContainerAuto();
		}
		// this.codeExcute();
	};
	code_function.prototype={
		test:function()
		{
			var self=this;
			yy_init($(document).width());
		},
		caCodeContainerAuto:function()
		{
			var self=this;
			var screenHeight=parseInt(window.innerHeight);
			if(screenHeight>self.heightCheck){
				$(".ca_code_container").css("height",screenHeight+"px");
				self.heightCheck=screenHeight;
			}
		}
	},
	window['code_function']=code_function;
})(jQuery);