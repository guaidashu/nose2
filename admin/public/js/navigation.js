;(function($){
	var navigation_function=function(){
		var self=this;
		// yy_init("OK");
		this.body=$(document.body);
		this.body.delegate(".ca_admin_exit", "click", function(){
			if(confirm("确定退出？")){
				self.signOut();
			}
		});
	};
	navigation_function.prototype={
		signOut:function()
		{
			var self=this;
			$.ajax({
				url:"/login/signOut.html",
				type:"GET",
				dataType:"json",
				data:{},
				success:function(data){
					if(data.text=="ok"){
						yy_init("成功退出");
						location.href="/login/index.html";
					}else{
						yy_init("退出失败");
					}
				},
				error:function(data,status,e){
					yy_init("系统错误，请稍后再试");
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