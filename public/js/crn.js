;(function($){
	var crn_function=function()
	{
		var self=this;
		this.body=$(document.body);
		this.test();
	};
	crn_function.prototype={
		test:function()
		{
			yy_init($(document).width());
		}
	}
	window['crn_function']=crn_function;
})(jQuery);