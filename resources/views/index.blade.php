<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('common/head')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/index.css')}}" />
<title>
计算机协会官网
</title>
</head>
<body>
<!--[if lte IE 9 ]>
<div class="am-alert am-alert-danger ie-warning" data-am-alert>
  <button type="button" class="am-close">&times;</button>
  <div class="am-container">
    365 安全卫士提醒：你的浏览器太古董了，妹子无爱，<a
    href="http://browsehappy.com/" target="_blank">速速点击换一个</a>！</div></div>
<![endif]-->
@include('common/navigation')

<!-- 图片轮播器 -->
<div class="rollpic">
    <div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
      <ul class="am-slides">
        <li><img src="./images/curousel/bing-1.jpg" /></li>
        <li><img src="./images/curousel/bing-2.jpg" /></li>
        <li><img src="./images/curousel/bing-3.jpg" /></li>
        <li><img src="./images/curousel/bing-4.jpg" /></li>
      </ul>
    </div>
</div>
<!-- 协会介绍 -->
<div class="ca_association_introduce ca_association_introduce_first">
    <div class="ca_association_introduce_title">
        协会简介
    </div>
    <div class="ca_association_introduce_content">
        计算机技术协会原名大学生网络技术协会，创建于2002年9月自创立以来，一直致力于对协会会员以及学院同学IT文化和理念的传播，以及专业技术能力的培养.
    </div>
</div>

<!-- 第一张可滚动图片(js实现) -->
<div class="ca_association_introduce_img_1 ca_bg_img_1" data-background="./images/background/bg_1.jpg">
    <div class="ca_association_introduce_img_1_content_container">
        <div class="ca_association_introduce_img_1_content">
            <div class="ca_association_introduce_img_1_content_1">
                <span class="ca_span_img">每一次的小收获</span>
            </div>
            <div class="ca_association_introduce_img_1_content_2">
                <span class="ca_span_img">都将是你的财富，和回忆</span>
            </div>
        </div>
    </div>
</div>

<!-- 学习方向 -->
<div class="ca_association_introduce" style="border-bottom:none;background-color:#f2f2f5;padding-bottom:15px;">
    <div class="ca_association_introduce_title">
        学习方向
    </div>
    <div class="ca_association_introduce_content">
        计算机技术协会是一个学习各类IT技术的地方。我们也有详细的方向，下面列出的便是主要的一些大致编程语言学习方向。
    </div>
</div>

<!-- 学习方向段列表 -->
<div class="ca_study_container" style="background-color:#f2f2f5;">
    <div class="ca_study">
        <ul class="ca_study_ul" id="ca_study_ul">
            <li class="ca_study_ul_li ca_study_ul_li_first">
                <div class="ca_study_content_container">
                    <div class="ca_study_imgae ca_study_image_1">
                    </div>
                    <div class="ca_study_content">
                        Java
                    </div>
                </div>
            </li>
            <li class="ca_study_ul_li ca_study_ul_li_third">
                <div class="ca_study_content_container">
                    <div class="ca_study_imgae ca_study_image_2">
                    </div>
                    <div class="ca_study_content">
                        Android
                    </div>
                </div>
            </li>
            <li class="ca_study_ul_li ca_study_ul_li_second ca_study_ul_li_forth">
                <div class="ca_study_content_container">
                    <div class="ca_study_imgae ca_study_image_3">
                    </div>
                    <div class="ca_study_content">
                        Web
                    </div>
                </div>
            </li>
            <li class="ca_study_ul_li ca_study_ul_li_third ca_study_ul_li_forth">
                <div class="ca_study_content_container">
                    <div class="ca_study_imgae ca_study_image_4">
                    </div>
                    <div class="ca_study_content">
                        Network
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>


<!-- 第二张可滚动图片(js实现) -->
<div class="ca_association_introduce_img_1 ca_bg_img_2" data-background="./images/background/bg_1.jpg">
    <div class="ca_association_introduce_img_1_content_container">
        <div class="ca_association_introduce_img_1_content">
            <div class="ca_association_introduce_img_1_content_1">
                <span class="ca_span_img">每一段夕阳下的旅程</span>
            </div>
            <div class="ca_association_introduce_img_1_content_2">
                <span class="ca_span_img">味道，总会弥漫整个青春</span>
            </div>
        </div>
    </div>
</div>
<!-- 协会目标 -->
<div class="ca_association_introduce" style="border-bottom:none;">
    <div class="ca_association_introduce_title">
        协会目标
    </div>
    <div class="ca_association_introduce_content">
        我们坚持不抛弃不放弃的基本原则，给每一个会员公平的参与项目和学习的机会，只要你愿意，都可以来技术部或者其他部门施展你的才华，挥洒你的青春。
    </div>
</div>
<!-- 第三张可滚动图片(js实现) -->
<div class="ca_association_introduce_img_1 ca_bg_img_3" data-background="./images/background/bg_1.jpg">
    <div class="ca_association_introduce_img_1_content_container">
        <div class="ca_association_introduce_img_1_content">
            <div class="ca_association_introduce_img_1_content_1">
                <span class="ca_span_img">只要努力了</span>
            </div>
            <div class="ca_association_introduce_img_1_content_2">
                <span class="ca_span_img">天高任鸟飞，海阔凭鱼跃</span>
            </div>
        </div>
    </div>
</div>

<div class="ca_association_introduce_container">
    <div id="ca_association_introduce_container">
        <div class="ca_association_introduce_container_right">
            <div class="right_content_1">
                来加入我们，我们可以
            </div>
            <div class="right_content_1" style="margin-left:100px;margin-bottom:20px;">
                一起唱歌，学习，骑车
            </div>
            <div class="right_content_3">
                融洽的我们
            </div>
            <div class="right_content_2">
                这个大学，在你加入我们之后
            </div>
            <div class="right_content_2">
                技术这条路就再也不会感到孤独
            </div>
            <div class="right_content_4">
                <p class="right_content_4_p_1">
                    线下联系
                </p>
                <p class="right_content_4_p_2">
                    经常交流
                </p>
                <p class="right_content_4_p_3">
                    课程
                </p>
            </div>
        </div>
        <div class="ca_association_introduce_container_left">
            <!-- 三个小图标 -->
            <div class="fig1" data-am-scrollspy="{animationj:'slide-left',delay: 100}">
            </div>
            <div class="fig2" data-am-scrollspy="{animation:'slide-left',delay: 300}">
            </div>
            <div class="fig3" data-am-scrollspy="{animation:'slide-left',delay: 500}">
            </div>
        </div>
    </div>
</div>
<div class="ca_association_introduce_bottom">
</div>

<!-- 回到顶部 -->
<!-- <div class="amz-toolbar" id="amz-toolbar">
    <a href="" data-am-smooth-scroll title="回到顶部" class="am-icon-btn am-icon-arrow-up" id="amz-go-top"></a> 
    <a href="/getting-started/faq" title="常见问题" class="am-icon-faq am-icon-btn am-icon-question-circle"></a>
</div> -->
<!-- <script type="text/javascript" src="./amaze/js/amazeui.js"></script> -->
@include('common/bottom')
<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
</body>
</html>