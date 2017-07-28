<!-- 侧边导航栏内容 -->
<div class="nav_side">
	<div class="ca_admin_spacing">
	</div>
	<div class="ca_logo_container">
		<div class="ca_logo">
		</div>
	</div>
	<ul class="am-list am-list-self admin-sidebar-list" id="collapase-nav-1">
	  <li  class="am-panel">
	    <a  href="{{url('index/index.html')}}"><i class="am-icon-home am-margin-left-sm"></i> 首页</a>
	  </li>

	  <li class="am-panel">
	    <a data-am-collapse="{parent: '#collapase-nav-1', target: '#user-nav'}">
	        <i class="am-icon-users am-margin-left-sm"></i> 人员管理 <i class="am-icon-angle-right am-fr am-margin-right"></i>
	    </a>
	    <ul class="am-list am-collapse admin-sidebar-sub" id="user-nav">
	        <li><a href="#"><i class="am-icon-user am-margin-left-sm"></i> 入会申请 </a></li>
	        <li><a href="#"><i class="am-icon-user am-margin-left-sm"></i> 人员列表 </a></li>
	    </ul>
	  </li>

	  <li class="am-panel">
	    <a data-am-collapse="{parent: '#collapase-nav-1', target: '#company-nav'}">
	        <i class="am-icon-table am-margin-left-sm"></i> 部门管理 <i class="am-icon-angle-right am-fr am-margin-right"></i>
	    </a>
	    <ul class="am-list am-collapse admin-sidebar-sub" id="company-nav">
	        <li><a href="#"><span class="am-icon-table am-margin-left-sm"></span> 添加部门 </a></li>
	        <li><a href="#"><span class="am-icon-table am-margin-left-sm"></span> 部门列表 </a></li>
	    </ul>
	  </li>

	  <li class="am-panel">
	    <a data-am-collapse="{parent: '#collapase-nav-1', target: '#ca_admin_article'}">
	        <i class="am-icon-book am-margin-left-sm"></i> 文章 <i class="am-icon-angle-right am-fr am-margin-right"></i>
	    </a>
	    <ul class="am-list am-collapse admin-sidebar-sub" id="ca_admin_article">
	        <li><a href="#"><span class="am-icon-eyedropper am-margin-left-sm"></span> 文章发布 </a></li>
	        <li><a href="#"><span class="am-icon-close am-margin-left-sm"></span> 删除文章 </a></li>
	    </ul>
	  </li>

	  <li class="am-panel">
	    <a href="#"><i class="am-icon-wpforms am-margin-left-sm"></i> 算法报名名单</a>
	  </li>
	</ul>
</div>