;(function($){
	var navigation_function=function(){
		var self=this;
		this.body = $(document.body);
		// yy_init("OK");
		this.body.delegate(".ca_exit", "click", function(){
			self.loginExit();
		});
	};
	navigation_function.prototype={
		loginExit:function()
		{
			var self = this;
			$.ajax({
				url:"/login/loginExit.html",
				type:"GET",
				dataType:"json",
				data:{},
				success:function(data){
					if(data.text=="ok"){
						location.href = "/index/index.html";
					}else{
						yy_init("退出失败，请重试");
					}
				},
				error:function(data, status, e){
					console.log(e);
				}
			});
		}
	}
	window['navigation_function']=navigation_function;
})(jQuery);
$(function(){
	var navigation=new navigation_function();
});