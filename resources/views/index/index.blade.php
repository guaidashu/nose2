<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('./../common/head')

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
@include('./../common/navigation')

<!-- 图片轮播器 -->
<div class="rollpic">
    <div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
      <ul class="am-slides">
        <li><img src="{{URL::asset('images/curousel/bing-1.jpg')}}" /></li>
        <li><img src="{{URL::asset('images/curousel/bing-2.jpg')}}" /></li>
        <li><img src="{{URL::asset('images/curousel/bing-3.jpg')}}" /></li>
        <li><img src="{{URL::asset('images/curousel/bing-4.jpg')}}" /></li>
      </ul>
    </div>
</div>
<!-- 协会介绍 -->
<div class="ca_association_introduce" >
    <div class="ca_association_introduce_title">
        协会简介
    </div>
    <div class="ca_association_introduce_content">
        计算机技术协会原名大学生网络技术协会，创建于2002年9月自创立以来，一直致力于对协会会员以及学院同学IT文化和理念的传播，以及专业技术能力的培养.
    </div>
</div>

<!-- 协会简介的一些活动介绍之类的 -->
<div class="ca_study_container">
    <div class="act_show_container">
        <div class="act_show_left_container">
            <ul>
                <li>
                    <sapn class="ca_icon_span"><i class="am-icon-battery-full ca_icon_size"></i></sapn>
                    <dl>
                        <dt>我们时刻充满活力</dt>
                        <dd>我们勤于学习，乐于助人，同时还积极向上，争取为自己打拼出一个未来，为学校做出力所能及的贡献</dd>
                    </dl>
                </li>
                <li>
                    <sapn class="ca_icon_span"><i class="am-icon-television ca_icon_size" style="margin-left:-17px;"></i></sapn>
                    <dl>
                        <dt>怀着不屈的心研究</dt>
                        <dd>技术难题总会困扰大家，但是我们从来不会因此而停住脚步。</dd>
                    </dl>
                </li>
                <li>
                    <sapn class="ca_icon_span"><i class="am-icon-wifi ca_icon_size" style="margin-left:-18px;"></i></sapn>
                    <dl>
                        <dt>技术总监的小心思</dt>
                        <dd>赶快来加入我大项目部把，嘿嘿。办公室有免费wifi随便你用。</dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="act_show_right_container">
            <div class="">
            </div>
        </div>
    </div>
</div>

<!-- 第一张可滚动图片(js实现) -->
<div class="ca_association_introduce_img_1 ca_bg_img_1" data-background="{{URL::asset('images/background/bg_1.jpg')}}">
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
<div class="ca_association_introduce" style="background-color:#f2f2f5;padding-bottom:15px;">
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

<!-- 协会简介的一些活动介绍之类的 2 -->
<div class="ca_study_container">
    <div class="act_show_container_2">
        <div class="act_show_left_container_2">
            <div class="act_show_title">
                总是持之以恒
            </div>
            <div class="act_show_content">
                计算机技术协会是由计算机学院主办，计算机学院党团总支直接领导管理的面向全校的专业技术型学生社团。开展学术讨论，普及计算机技术知识，传播计算机文化和相关理念，扶植计算机技术爱好者，培养更多计算机技术方面的人才。
                <br /><br />
                <img src="{{URL::asset('images/introduce_bottom/xpic8326.jpg')}}" width="100%" class="act_show_left_img" />
            </div>
        </div>
        <div class="act_show_right_container_2">
            <div class="act_show_title">
                我们长远的目标
            </div>
            <div class="act_show_content">
                为确保计算机技术协会能够更加健康茁壮的发展，使之运转高效化，规范化，制度化，并朝着专业化战略化方向发展，我们必须要有自己更远的想法。计算机技术协会，创建于2002年9月，自创立以来，一直致力于对计算机文化和相关理念的传播，以及专业技术能力的培养。我们希望，可以针对到每个人，让他学习更加透彻，学习到计算机技术的本质。而不是只是会写代码。
                <br /><br /><br/>
                计算机技术协会的口号是：以人为本，以技术为魂，以社会为舞台，以竞争为动力。在学校和指导部门允许和要求的情况下接取一些开发项目（学校的或者校外的），用于将会员平时所学理论和实践结合起来；锻炼大家的实战能力。
            </div>
        </div>
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
  <!-- 回到顶部 -->
  <!-- <div class="amz-toolbar go_top_index">
     <a href="" data-am-smooth-scroll title="回到顶部" class="am-icon-btn am-icon-arrow-up" id="amz-go-top"></a> 
  </div> -->
  <div class="ca_bottom_container">
    <div class="ca_bottom_welcome">
      计算机技术协会
    </div>
    <div class="ca_bottom_main_container">
        <div class="ca_bottom_main_study">
            <ul class="ca_bottom_main_ul">
                <li style="margin-bottom:8px;">学习栏目</li>
                <li><a href="http://www.imooc.com/" target="_blank" title="慕课网">慕课网</a></li>
                <li><a href="http://www.webhek.com/" target="_blank" title="web骇客">web骇客</a></li>
                <li><a href="http://www.runoob.com/" target="_blank" title="菜鸟教程">菜鸟教程</a></li>
                <li><a href="https://www.liaoxuefeng.com/" target="_blank" title="廖雪峰官网">廖雪峰官网</a></li>
                <li><a href="http://lx.lanqiao.cn/" target="_blank" title="蓝桥杯算法练习">蓝桥杯算法练习</a></li>
            </ul>
        </div>
        <div class="ca_bottom_main_friend">
            <ul class="ca_bottom_main_ul">
                <li style="margin-bottom:8px;">友情链接</li>
                <li><a href="https://www.xsdhy.com/" target="_blank" title="消逝的红叶">消逝的红叶</a></li>
                <li><a href="http://www.erzone.cn/" target="_blank" title="田西秦的博客">田西秦的博客</a></li>
                <li><a href="http://blog.gotz9.cn/" target="_blank" title="gotz9">gotz9</a></li>
                <li><a href="http://www.vvlove.cc/" target="_blank" title="Q1: (V ❤ C) √">Q1: (V ❤ C) √</a></li>
                <li><a href="https://suse.xsdhy.com/" target="_blank" title="川理在线">川理在线</a></li>
            </ul>
        </div>
        <div class="ca_bottom_main_school">
            <ul class="ca_bottom_main_ul">
                <li style="margin-bottom:8px;">学校链接</li>
                <li><a href="http://www.suse.edu.cn/" target="_blank" title="四川理工官网">四川理工官网</a></li>
                <li><a href="http://jsj.suse.edu.cn/" target="_blank" title="计算机学院">计算机学院</a></li>
                <li><a href="http://lib.suse.edu.cn/" title="图书馆">图书馆</a></li>
                <li><a href="http://zjc.suse.edu.cn/p/0/?StId=st_app_news_i_x636359688054594682" target="_blank" title="录取查询">录取查询</a></li>
            </ul>
        </div>
        <ul class="ca_bottom_ul am-list admin-sidebar-list" id="collapase-nav-1">

          <li class="am-panel">
            <a data-am-collapse="{parent: '#collapase-nav-1', target: '#user-nav'}">
                学习栏目 <i class="am-icon-angle-right am-fr am-margin-right"></i>
            </a>
            <ul class="am-list am-collapse admin-sidebar-sub" id="user-nav">
                <li><a href="http://www.imooc.com/" target="_blank" title="慕课网">慕课网</a></li>
                <li><a href="http://www.webhek.com/" target="_blank" title="web骇客">web骇客</a></li>
                <li><a href="http://www.runoob.com/" target="_blank" title="菜鸟教程">菜鸟教程</a></li>
                <li><a href="https://www.liaoxuefeng.com/" target="_blank" title="廖雪峰官网">廖雪峰官网</a></li>
                <li><a href="http://lx.lanqiao.cn/" target="_blank" title="蓝桥杯算法练习">蓝桥杯算法练习</a></li>
            </ul>
          </li>

          <li class="am-panel">
            <a data-am-collapse="{parent: '#collapase-nav-1', target: '#company-nav'}">
                友情链接<i class="am-icon-angle-right am-fr am-margin-right"></i>
            </a>
            <ul class="am-list am-collapse admin-sidebar-sub" id="company-nav">
                <li><a href="https://www.xsdhy.com/" target="_blank" title="消逝的红叶">消逝的红叶</a></li>
                <li><a href="http://www.erzone.cn/" target="_blank" title="田西秦的博客">田西秦的博客</a></li>
                <li><a href="http://blog.gotz9.cn/" target="_blank" title="gotz9">gotz9</a></li>
                <li><a href="http://www.vvlove.cc/" target="_blank" title="Q1: (V ❤ C) √">Q1: (V ❤ C) √</a></li>
                <li><a href="https://suse.xsdhy.com/" target="_blank" title="川理在线">川理在线</a></li>
            </ul>
          </li>

          <li class="am-panel">
            <a data-am-collapse="{parent: '#collapase-nav-1', target: '#role-nav'}">
                学校链接<i class="am-icon-angle-right am-fr am-margin-right"></i>
            </a>
            <ul class="am-list am-collapse admin-sidebar-sub" id="role-nav">
                <li><a href="http://www.suse.edu.cn/" target="_blank" title="四川理工官网">四川理工官网</a></li>
                <li><a href="http://jsj.suse.edu.cn/" target="_blank" title="计算机学院">计算机学院</a></li>
                <li><a href="http://lib.suse.edu.cn/" title="图书馆">图书馆</a></li>
                <li><a href="http://zjc.suse.edu.cn/p/0/?StId=st_app_news_i_x636359688054594682" target="_blank" title="录取查询">录取查询</a></li>
            </ul>
          </li>
        </ul>
    </div>
    <div class="ca_bottom_record">
      Copyright &#169; 2017 计算机技术协会 Designed by 奕弈   &nbsp; <a target="oo" href="http://www.miitbeian.gov.cn/" style="color:#979797;">蜀ICP备16013626号</a>
    </div>
  </div>
</div>

<!-- 回到顶部 -->
<!-- <div class="amz-toolbar" data-am-sticky>
    <a href="" data-am-smooth-scroll title="回到顶部" class="am-icon-btn am-icon-arrow-up" id="amz-go-top"></a> 
</div> -->
<!-- <div data-am-widget="gotop" class="am-gotop am-gotop-default" >
    <a href="#top" title="回到顶部">
        <span class="am-gotop-title">回到顶部</span>
          <i class="am-gotop-icon am-icon-chevron-up"></i>
    </a>
</div> -->
@include('./../common/bottom')

<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
</body>
</html>