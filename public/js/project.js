;(function($){
	var project_function=function()
	{
		var self=this;
		this.body=$(document.body);
		// test用来弹出屏幕宽度用于自适应开发
		// this.test();

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
			// 获取到project1的所有对象
			var projectObj=document.getElementsByName("project1");
			var obj2=document.getElementsByName("project1_left");
			var obj3=document.getElementsByName("project1_right");
			var len=projectObj.length;
			var height;
			for(var i=0;i<len;i++){
				height2=obj2[i].offsetHeight;
				height3=obj3[i].offsetHeight;
				if(screenWidth > 650){
					projectObj[i].style.height=height3+"px";
				}else{
					projectObj[i].style.height=height2+height3+"px";
				}
			}
			// yy_init(height);
			// var height=parseInt($(".project1_right").height());
			// var height_2=parseInt($(".project1_left").height());
			// if(screenWidth > 650){
			// 	$(".project1").css("height",height+45+"px");
			// }else{
			// 	$(".project1").css("height",height+45+height_2+"px");
			// }
		}
	}
	window['project_function']=project_function;
})(jQuery);