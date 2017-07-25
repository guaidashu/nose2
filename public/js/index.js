;(function($){
	var index_function=function(){
		var self=this;
		this.pageY;
		this.body=$(document.body);
		//这个属性成员（this.lastMaxScreenHeight）用来判断自适应的时候是不是高度变化了
		//因为我的想法是，
		//如果当前页面尺寸发生变化了
		//并且高度变得比当前高度大了，那么自适应有一些组建就应该相应变大
		//相反的，如果变得比当前高度小了，那么就不需要改变
		this.lastMaxScreenHeight=0;
		// 图片的自适应比例
		this.proportion1;
		//test为显示屏幕当前宽度，document.width,方便自适应调试,单位px
		// this.test();
		this.caStudyContainerAuto();
		this.caIntroduceBottomAuto();
		this.caAimContainerAutoInit();
		this.caIntroduceBottomFigsAuto();
		// var obj=document.getElementById("ac_index_body");
		// 触屏事件测试
		// obj.addEventListener("touchmove",function(event){
		// 	if(event.targetTouches.length == 1){
		// 		event.preventDefault();//阻止浏览器默认事件
		// 		$("#ac_index_body").css({
		// 			"position":"fixed",
		// 			"top":parseInt($("#ac_index_body").css("top"))-event.pageY+"px",
		// 			"left":"0px"
		// 		});
		// 	}
		// });
		window.onload=function(){
			// 调用获取header以下部分背景图片尺寸函数
			self.getImgSize();
		}
		window.onresize=function(){
			self.caAssociationImgAuto();
			self.caStudyContainerAuto();
			self.caAimContainerAutoInit();
			self.caIntroduceBottomAuto();
			self.caIntroduceBottomFigsAuto();
		}
	};
	index_function.prototype={
		//函数定义方式  函数名:function(可传参数，也可以为空){}大括号后面记得习惯性的打上一个逗号
		//调用直接在index_function里面通过self.函数名()就可以直接调用
		
		// 用来设计自适应的时候查看宽度
		test:function(id){
			yy_init($(document).width());
		},
		// 展示图片自适应
		caAssociationImgAuto:function(){
			var self=this;
			//获取屏幕高度
			var screenHeight=window.innerHeight;
			if(self.lastMaxScreenHeight<screenHeight){
				self.lastMaxScreenHeight=screenHeight;
			}else{
				return 0;
			}
			//判断，若屏幕宽度小于640，则高度稍微加大，防止手机
			//有一些浏览器有顶部地址栏影响整体的观看
			if(parseInt($(document).width())<640){
				$(".ca_association_introduce_img_1").css("height",screenHeight*1.15+"px");
			}else{
				$(".ca_association_introduce_img_1").css("height","600px");
			}
			
		},
		// 获取图片尺寸，用创建一张新图的方式获取图片真实尺寸
		getImgSize:function(){
			var self=this;
			var img1Width;
			var img1Height;
			// 首先要获取图片的src
			var src1=$(".ca_association_introduce_img_1").attr("data-background");
			// 然后创建新图，加载完后再做操作
			$("<img />").attr("src",src1).load(function(){
				img1Width=this.width;
				img1Height=this.height;
				// 暂时没用
				self.proportion1=(img1Width/img1Height);
				self.caAssociationImgAuto();
			});
			// var load=function(){
			// 	self.caAssociationImgAuto();
			// }
			// return load;
		},
		// 学习方向段列表自适应
		caStudyContainerAuto:function(){
			var self=this;
			var screenWidth=parseInt($(document).width());
			var marginWidth;
			var width;
			// 学习图片下的文字行高
			$(".ca_study_content").css("line-height",parseInt($(".ca_study_content").css("height"))+"px");
			//若屏幕宽度小于500px，那么表示应该进行最小的适应
			//四个学习展示图片容器应该随着宽度的变化而变化，高度与宽度成比例缩小
			if(screenWidth<558){
				$(".ca_study_ul_li").css({
					"width":(screenWidth-45)/2+"px"
				});
				width=(screenWidth-45)/2;
				$(".ca_study_ul_li").css({
					"height":width*1.1+"px"
				});
				$(".ca_study").css("height",width*1.1*2+60+"px");
				$(".ca_study_ul_li_first").css("margin-left",-17+"px");
				$(".ca_study_ul_li_third").css({
					"margin-left":15+"px",
					"margin-right":15+"px"
				});
				$(".ca_study_ul_li_forth").css({
					"margin-top":"15px"
				});
				$(".ca_study_ul_li_second").css("margin-left","-17px");
				return 0;
			}else{
				width=240;
				$(".ca_study_ul_li").css({
					"width":"240px"
				});
			}
			// 设置margin-left的距离
			if(screenWidth>1050){
				marginWidth=(screenWidth-width*4-60)/3;
			}else{
				marginWidth=(screenWidth-width*2-60)/3;
			}
			// yy_init(width);
			// 高度随着宽度而减小
			$(".ca_study_ul_li").css({
				"height":width*1.1+"px"
			});
			$(".ca_study_ul_li_second").css("margin-left",marginWidth+"px");
			if(screenWidth<1050){
				$(".ca_study").css("height",width*1.1*2+60+"px");
				$(".ca_study_ul_li_first").css("margin-left",marginWidth+"px");
				$(".ca_study_ul_li_third").css({
					"margin-left":marginWidth+"px",
					"margin-right":marginWidth+"px"
				});
				$(".ca_study_ul_li_forth").css({
					"margin-top":"15px"
				});
			}else{
				$(".ca_study").css("height",width*1.1+45+"px");
				$(".ca_study_ul_li_third").css({
					"margin-right":"0px",
					"margin-left":marginWidth+"px"
				});
				$(".ca_study_ul_li_first").css("margin-left","0px");
				$(".ca_study_ul_li_forth").css({
					"margin-top":"0px"
				});
			}
		},
		//底部最后的介绍容器自适应初始化
		caAimContainerAutoInit:function(){
			var self=this;
			//获取屏幕宽度
			var screenWidth=parseInt($(document).width());
			//获取屏幕高度
			var screenHeight=window.innerHeight;
			//设置底部最后的介绍栏高度，自适应
			if(self.lastMaxScreenHeight<screenHeight){
				self.lastMaxScreenHeight=screenHeight;
			}else{
				return 0;
			}
			if(screenWidth>1020&&screenHeight>640){
				$(".ca_association_introduce_container").css("height",screenHeight+"px");
			}
		},
		//底部最后的展示，左侧图片top自适应函数，保证一直占据完整个容器
		caIntroduceBottomAuto:function(){
			var self=this;
			//获取屏幕宽度
			var screenWidth=parseInt($(document).width());
			//进行判断，若是屏幕宽度小于650，则进行高度定位
			if(screenWidth>650){
				$(".ca_association_introduce_container_left").css("top",parseInt($("#ca_association_introduce_container").css("height"))-506+"px");
				$(".ca_association_introduce_container_right").css("top",parseInt($("#ca_association_introduce_container").css("height"))-486+"px");
			}
		},
		//底部最后的展示，三个小图标的left自适应，以及right那边的left
		caIntroduceBottomFigsAuto:function(){
			var self=this;
			//获取屏幕宽度
			var screenWidth=parseInt($(document).width());
			//获取左侧图片的宽度
			var width=parseInt($(".ca_association_introduce_container_left").css("width"));
			//中间的figs应该离开的距离
			var divided=parseInt($(".fig2").css("width"))/2;
			$(".fig2").css({
				"margin-left":-divided-25+"px"
			});
			$(".fig1").css({
				"left":-parseInt($(".fig1").css("width"))/1.2+"px"
			});
			$(".fig3").css({
				"margin-left":-parseInt($(".fig3").css("width"))/2+"px"
			});
			$(".ca_association_introduce_container_right").css({
				"left":width+130+"px"
			})
		}
	}
	window['index_function']=index_function;
})(jQuery);
$(function(){
	var index=new index_function;
});