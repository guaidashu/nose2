;(function($){
	var findBookMsg_function = function()
	{
		var self = this;
		this.check=true;
		this.body = $(document.body);
		// this.test();
		$("form").submit(function(){
			var xh = document.getElementById("doc-vld-email-2").value;
			xh = $.trim(xh);
			if(!numCheck(xh)){
				yy_init("请输入15位的学号");
				return false;
			}
		});
		
	};
	findBookMsg_function.prototype = {
		test:function()
		{
			yy_init("ok");
		},
	}
	window['findBookMsg_function'] = findBookMsg_function;
})(jQuery);


function numCheck(num)
{
	var pattern = /^([0-9]){11}$/;
	if(!pattern.test(num)){
		return false;
	}else{
		return true;
	}
}