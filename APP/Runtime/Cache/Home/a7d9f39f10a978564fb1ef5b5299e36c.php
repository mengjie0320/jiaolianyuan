<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-教练详情介绍</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/coachDetail.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
</head>
<body>
<!--导航栏-->
<div id="top">
	<div id="nav">
        <img src="/jiaolianyuan/Public/images/public/logo.png" alt="教练缘" title="教练缘"/>
        <ul id="nav_left">
            <li><a href="/jiaolianyuan/Home/Index/index.html" target="_parent">首页</a></li>
            <li><a href="#" target="_parent">帮助中心</a></li>
              <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/Home/Coach/coach.html">自学中心</a></li><?php endif; ?>
			  <?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/Home/Student/student.html">自学中心</a></li><?php endif; ?>
			  <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/Home/Login/login.html" onclick="warn()">自学中心</a></li><?php endif; ?>       
        </ul>
        <ul id="nav_right">
            <?php if(($name != '') OR ($phone != '')): ?><b><a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>"></a></b>
            	<!--教练头像进入个人中心-->
				<?php if(($identity == 'teacher')): ?><p class="myp" id="myp">
				 	<a id="enterCenter" href="/jiaolianyuan/Home/Coach/coach.html"><?php echo ($name); ?></a>
				 	<span class="logout">
		 				<a href="/jiaolianyuan/Home/Login/logout">退出</a>
		 			</span>
		 			</p><?php endif; ?>
				 	<!--学员头像进入个人中心-->
				 	 
				 	<?php if(($identity == 'student')): ?><p class="myp" id="myp">
				 	<a id="enterCenter" href="/jiaolianyuan/Home/Student/personal.html"><?php echo ($name); ?></a>
				 	<span class="logout">
		 				<a href="/jiaolianyuan/Home/Login/logout">退出</a>
		 			</span>
		 			</p><?php endif; ?>		  
				<?php else: endif; ?>
        </ul>
    </div>
</div>
<div class="content">
	<div class="face">
		<img src="/jiaolianyuan/Public/images/<?php echo ($coachInfo[0]['face']); ?>" />
	</div>	
	<span><?php echo ($coachInfo[0]['tname']); ?></span>
	<div class="intro">
		<span>个人简介：</span>
		<p><?php echo ($coachInfo[0]['tintro']); ?></p>
	</div>
	<div class="detail">
		<span>详细介绍：</span>
		<ul class="mes_list">
			<li>
				<span>指导理念：</span>
				<p><?php echo ($coachInfo[0]['concept']); ?></p>
			</li>
			<li>
				<span>掌握技术：</span>
				<p><?php echo ($coachInfo[0]['skill']); ?></p>
			</li>
			<li>
				<span>实践项目：</span>
				<p><?php echo ($coachInfo[0]['doneproject']); ?></p>
			</li>
		</ul>
	</div>
</div>
<!--页面的底部-->
<div class="footer">
	<div class="my_footer">
		<ul class="footer_1">
			<li><a href="#"></a></li>
			<li><a href="#" id="weixin"><div class="weixin"></div></a></li>
			<li><a href="#"></a></li>
			<li><a href="#"></a></li>
		</ul>
		<div class="footer_2">
				<a href="#">关于我们</a>
				<a href="#">企业合作</a>
				<a href="#">人才招聘</a>
				<a href="#">讲师招募</a>
				<a href="#">联系我们</a>
				<a href="#">意见反馈</a>
				<a href="#">友情链接</a>
		</div>
		<div class="footer_3">
			<p>&copy;&nbsp;2016&nbsp;51jiaolianyuan&nbsp;粤ICP备&nbsp;18689008号</p>
		</div>
	</div>
</div>
</body>
</html>