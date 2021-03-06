<!--[if lte IE 9 ]>
<div class="am-alert am-alert-danger ie-warning" data-am-alert>
  <button type="button" class="am-close">&times;</button>
  <div class="am-container">
    365 安全卫士提醒：你的浏览器太古董了，妹子无爱，<a
    href="http://browsehappy.com/" target="_blank">速速点击换一个</a>！</div></div>
<![endif]-->
<!-- 顶部信息栏。包括登录信息(top message show(include login message)) -->
<div class="topbar">
    <div class="container">
      <div class="am-g">
        <div class="am-u-md-3">
          <div class="topbar-left">
            <i class="am-icon-globe"></i>
            <div class="am-dropdown" data-am-dropdown>
              <button class="am-btn am-btn-primary am-dropdown-toggle" data-am-dropdown-toggle>Language <span class="am-icon-caret-down"></span></button>
              <ul class="am-dropdown-content">
                <li><a href="#">English</a></li>
                <li class="am-divider"></li>
                <li><a href="#">Chinese</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="am-u-md-9">
          <div class="topbar-right am-text-right am-fr">
            Follow us
            <i class="am-icon-facebook"></i>
            <i class="am-icon-twitter"></i>
            <i class="am-icon-google-plus"></i>
            <i class="am-icon-pinterest"></i>
            <i class="am-icon-instagram"></i>
            <i class="am-icon-linkedin"></i>
            <i class="am-icon-youtube-play"></i>
            <i class="am-icon-rss"></i>
            @if(empty($name))
              <a href="{{url('login/index.html')}}">登录</a>
            @else
              <a href="#">{{$name}}</a>
              <a class="ca_exit cursor_pointer">退出</a>
            @endif
          </div>
        </div>
      </div>
    </div>
</div>


<!--header start-->
<div class="header-box" style="border-bottom:1px solid #e9e9e9;">
        
          <div class="container">
            <div class="header">
              <div class="am-g">
                <div class="am-u-lg-2 am-u-sm-12">
                  <div class="logo">
                    <a href="#" style="display:inline-block;width:100%;height:100%;"><img src="{{URL::asset('images/logo_1.png')}}" alt="logo" /></a>
                  </div>
                </div>
                <div class="am-u-md-10 am-u-sm-12">
                  <div class="header-right am-fr">
                    <div class="header-contact">
                      <div class="header_contacts--item ca_contacts_item_3">
                                            <div class="contact_mini">
                                                <i style="color:#7c6aa6" class="contact-icon am-icon-phone"></i>
                                                <strong>18882021307</strong>
                                                <span>周一~周五, 8:00 - 20:00</span>
                                            </div>
                                        </div>
                      <div class="header_contacts--item ca_contacts_item_2">
                                            <div class="contact_mini">
                                                <i style="color:#7c6aa6" class="contact-icon am-icon-envelope-o"></i>
                                                <strong>zhaung25712@163.com</strong>
                                                <span>随时欢迎您的来信！</span>
                                            </div>
                                        </div>
                      <div class="header_contacts--item ca_contacts_item_1">
                                            <div class="contact_mini">
                                                <i style="color:#7c6aa6" class="contact-icon am-icon-map-marker"></i>
                                                <strong>四川理工学院</strong>
                                                <span>教学楼416</span>
                                            </div>
                                        </div>
                    </div>
                    <a class="contact-btn" href="http://wpa.qq.com/msgrd?v=3&uin=1023767856&site=qq&menu=yes" target="_blank">
                      <button type="button" class="am-btn am-btn-secondary am-radius">联系我们</button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
</div>

<!--header end-->

<!--nav start-->
<div class="nav-contain ca_nav" data-am-sticky style="border-top:none;">
  <div class="nav-inner">
    <ul class="am-nav am-nav-pills am-nav-justify">
      <li class=""><a href="{{url('index/index.html')}}">首页</a></li>
      <li>
        <a href="{{url('project/index.html')}}">项目中心</a>
        <!-- sub-menu start-->
        <ul class="sub-menu">
          <li class="menu-item"><a href="http://sh.wyysdsa.cn/" target="_blank">超级作业</a></li>
          <li class="menu-item"><a href="http://stu.wyysdsa.com/" target="_blank">查寝系统</a></li>
          <li class="menu-item"><a href="https://suse.xsdhy.com/" target="_blank">川理在线</a></li>
        </ul>
        <!-- sub-menu end-->
      </li>
      <li><a href="#">资源共享</a></li>
      <li><a href="#">部门中心</a>
          <ul class="sub-menu">
              <li class="menu-item"><a href="#">技术部门</a></li>
              <li class="menu-item"><a href="#">组织部门</a></li>
              <li class="menu-item"><a href="#">外交部门</a></li>
          </ul>
      </li>
      <li>
        <a href="#">川理在线</a>
        <!-- sub-menu start-->
        <ul class="sub-menu">
          <!-- <li class="menu-item"><a href="{{url('act/algorithm.html')}}">算法入门报名</a></li> -->
          <li class="menu-item"><a href="{{url('act/grade.html')}}">成绩查询</a></li>
          <li class="menu-item"><a href="{{url('act/findClass.html')}}">学号查询</a></li>
          <li class="menu-item"><a href="{{url('act/saveExamRegistration.html')}}">四六级准考证备忘</a></li>
          <li class="menu-item"><a href="{{url('act/findGrade.html')}}">四六级成绩查询</a></li>
          <li class="menu-item"><a href="{{url('act/getGradeNum.html')}}">四六级准考证查询</a></li>
          <li class="menu-item"><a href="{{url('act/findBookMsg.html')}}">图书借阅信息</a></li>
          <li class="menu-item"><a href="{{url('act/code.html')}}">在线代码编译</a></li>
        </ul>
        <!-- sub-menu end-->
      </li>
      <li><a href="{{url('crn/changeInfo.html')}}">个人信息</a></li>
      <li><a href="{{url('about/index.html')}}">关于我们</a></li>
      <!-- <li><a href="html/contact.html">联系我们</a></li> -->
    </ul>
  </div>
</div>
<!--nav end-->

<!--mobile header start-->
<div class="m-header ca_m_header">
  <div class="am-g am-show-sm-only">
    <div class="am-u-sm-2">
      <div class="menu-bars">
        <a data-rel="open" class="doc-oc-js cursor_pointer"><i class="am-menu-toggle-icon am-icon-bars"></i></a>
        <!-- 侧边栏内容 -->
        <nav data-am-widget="menu" class="am-menu  am-menu-offcanvas1" data-am-menu-offcanvas >

        <div id="doc-oc-demo1" class="am-offcanvas" >
          <div class="am-offcanvas-bar">
          <ul class="am-menu-nav am-avg-sm-1">
              <li><a href="{{url('index/index.html')}}" class="" >首页</a></li>
              <li class="am-parent">
                <a href="" class="" >项目中心</a>
                  <ul class="am-menu-sub am-collapse ">
                    <li class="">
                        <a href="{{url('project/index.html')}}" class="" target="_blank" >项目中心</a>
                      </li>
                      <li class="">
                        <a href="http://sh.wyysdsa.cn/" class="" target="_blank" >超级作业</a>
                      </li>
                      <li class="">
                        <a href="http://www.wyysdsa.com/stucontrol/" class="" target="_blank">查寝系统</a>
                      </li>
                      <li class="">
                        <a href="http://www.wyysdsa.cn:1965" class="" target="_blank">川理在线</a>
                      </li>
                  </ul>
              </li>
              <li class=""><a href="#" class="" >资源共享</a></li>
              <li class="am-parent"><a href="#" class="" >部门中心</a>
                  <ul class="am-menu-sub am-collapse  ">
                      <li class="">
                        <a href="#" class="" >技术部门</a>
                      </li>
                      <li class="">
                        <a href="#" class="" >组织部门</a>
                      </li>
                      <li class="">
                        <a href="#" class="" >外交部门</a>
                      </li>
                  </ul>
              </li>
              <li class="am-parent">
                <a href="#" class="" >川理在线</a>
                  <ul class="am-menu-sub am-collapse  ">
                      <li class="">
                        <a href="{{url('act/grade.html')}}" class="" >成绩查询</a>
                      </li>
                      <li class="">
                        <a href="{{url('act/findClass.html')}}" class="" >学号查询</a>
                      </li>
                      <li class="">
                        <a href="{{url('act/saveExamRegistration.html')}}">四六级准考证备忘</a>
                      </li>
                      <li class="">
                        <a href="{{url('act/findGrade.html')}}">四六级成绩查询</a>
                      </li>
                      <li class="">
                        <a href="{{url('act/getGradeNum.html')}}">四六级准考证查询</a>
                      </li>
                      <li class="">
                        <a href="{{url('act/findBookMsg.html')}}">图书借阅信息</a>
                      </li>
                      <li class="">
                        <a href="{{url('act/code.html')}}" class="" >在线代码编译</a>
                      </li>
                  </ul>
              </li>
              <li class=""><a href="{{url('crn/changeInfo.html')}}" class="" >个人信息</a></li>
              <li class=""><a href="{{url('about/index.html')}}" class="" >关于我们</a></li>
              <li class=""><a href="http://wpa.qq.com/msgrd?v=3&uin=1023767856&site=qq&menu=yes" target="_blank" class="" >联系我们</a></li>
              <li class="am-parent">
                <a href="" class="nav-icon nav-icon-globe" >Language</a>
                  <ul class="am-menu-sub am-collapse  ">
                      <li>
                        <a href="#" >English</a>
                      </li>
                      <li class="">
                        <a href="#" >Chinese</a>
                      </li>
                  </ul>
              </li>
              <li class="nav-share-contain">
                <div class="nav-share-links">
                  <i class="am-icon-facebook"></i>
                  <i class="am-icon-twitter"></i>
                  <i class="am-icon-google-plus"></i>
                  <i class="am-icon-pinterest"></i>
                  <i class="am-icon-instagram"></i>
                  <i class="am-icon-linkedin"></i>
                  <i class="am-icon-youtube-play"></i>
                  <i class="am-icon-rss"></i>
                </div>
              </li>
              @if(empty($name))
                <li class=""><a href="{{url('login/index.html')}}" class="">登录</a></li>
                <!-- <li class=""><a href="#" class="">注册</a></li> -->
              @else
                <li class=""><a href="#" class="">{{$name}}</a></li>
                <li class=""><a class="ca_exit cursor_pointer">退出</a></li>
              @endif
          </ul>

          </div>
        </div>
      </nav>

      </div>
    </div>
    <div class="am-u-sm-5 am-u-end">
      <div class="m-logo">
        <a href="{{url('index/index.html')}}" ><img src="{{URL::asset('images/logo.png')}}" style="margin-top:-2px;" alt="logo" /></a>
      </div>
    </div>
  </div>
<!--mobile header end-->
</div>