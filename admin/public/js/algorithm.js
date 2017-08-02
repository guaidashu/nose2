;(function($){
	var algorithm_function=function()
	{
		var self=this;
		this.body=$(document.body);
		this.autoNavHeight();
		this.autoContainerWidth();
		this.autoAlgorithmHeight();
		this.body.delegate(".ca_admin_algorithm_delete", "click", function(){
			if(confirm("确定删除？")){
				self.algorithm_delete($(this));
			}
		});
		this.body.delegate(".ca_admin_algorithm_more", "click", function(){
			self.algorithm_more($(this));
		});
		// test用来设置自适应查看屏幕宽度
		// this.test();
		window.onresize=function()
		{
			self.autoNavHeight();
			self.autoContainerWidth();
			self.autoAlgorithmHeight();
		}
	};
	algorithm_function.prototype={
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
		autoAlgorithmHeight:function()
		{
			var self=this;
			var screenHeight=window.innerHeight;
			var screenWidth=parseInt($(document).width());
			if(screenWidth>680){
				$(".ca_admin_algorithm").css("height",screenHeight);
			}else{
				$(".ca_admin_algorithm").css("min-height","0px");
			}
		},
		algorithm_delete:function(id)
		{
			var self=this;
			var delete_id=id.attr("data-id");
			$.ajax({
				url:"/algorithm/delete.html",
				type:"GET",
				dataType:"json",
				data:{"id":delete_id},
				success:function(data){
					if(data.text=="ok"){
						yy_init("删除成功");
					}
					id.parent().parent().remove();
				},
				error:function(data,status,e){
					yy_init("系统错误，删除失败");
					console.log(e);
				}
			});
		},
		algorithm_more:function(id)
		{
			var self=this;
			var name=id.attr("data-name");
			var subject=id.attr("data-subject");
			var date=id.attr("data-date");
			var phone=id.attr("data-phone");
			var email=id.attr("data-email");
			var str="姓名："+name
					+"\n专业："+subject
					+"\n电话："+phone
					+"\n邮箱："+email
					+"\n报名时间："+date;
			yy_time_init(str,"详细信息",true);
		}
	}
	window['algorithm_function']=algorithm_function;
})(jQuery);
$(function(){
	var index=new algorithm_function();
});