<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>教练缘-班级列表</title>
	<link rel="stylesheet" href="/jiaolianyuan/Public/CSS/common.css" />
	<link rel="stylesheet" href="/jiaolianyuan/Public/CSS/class-list.css" />
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js" ></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/class-list.js" ></script>				
</head>
<body>
<div class="top-warp">
	<div class="top">
		<a class="logo" href="/jiaolianyuan/index.php/Home/Index/index.html">教练缘，企业人才定制与自学平台</a>
		<?php if(($name != '') OR ($phone != '')): ?><div class="card-warp">
			 	<img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" >
			 	<!--教练头像进入个人中心-->
			    <?php if(($identity == 'teacher')): ?><p class="card">
			    	<a class="user"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" ><strong><?php echo ($name); ?></strong></a>
				 	<a class="personal" href="/jiaolianyuan/index.php/Home/Coach/coach.html">个人中心</a>
		 			<a class="signout" href="/jiaolianyuan/index.php/Home/Login/logout">退出</a>
		 			<i class="card-arrow"></i>
		 		</p><?php endif; ?>
				<!--学员头像进入个人中心-->
				<?php if(($identity == 'student')): ?><p class="card">
					<a class="user"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" ><strong><?php echo ($name); ?></strong></a>
					<a class="learn" href="/jiaolianyuan/index.php/Home/Student/student.html">自学中心</a>
				 	<a class="personal" href="/jiaolianyuan/index.php/Home/Student/personal.html">个人中心</a>
		 			<a class="signout"  href="/jiaolianyuan/index.php/Home/Login/logout">退出</a>
		 			<i class="card-arrow"></i>
		 		</p><?php endif; ?>
			</div>
		 	<?php else: ?>
				<a class="login"  href="/jiaolianyuan/index.php/Home/Login/login">登录</a>
				<a class="register" href="/jiaolianyuan/index.php/Home/Register/register">注册</a><?php endif; ?>  
	</div>
</div>
<!--导航-->
<div class="nav-warp">
	<ul class="nav">
		<li><a href="/jiaolianyuan/index.php/Home/Index/index.html" target="_parent">首页</a></li>
        <li><a href="#">帮助中心</a></li>
        <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/index.php/Home/Coach/coach.html">个人中心</a></li><?php endif; ?>
		<?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/index.php/Home/Student/student.html">自学中心</a></li><?php endif; ?>
		<?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/index.php/Home/Login/login.html" onclick="warn()">自学中心</a></li><?php endif; ?>
	</ul>
</div>
<!--职位列表-->
<div class="name-list">
	<span>班级：</span>
	<ul class="choose-list">
		<li class="active"><a  href="#">全部</a></li>
		<?php if(is_array($coursecate)): $i = 0; $__LIST__ = $coursecate;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$coursecate): $mod = ($i % 2 );++$i;?><li><a href="/jiaolianyuan/index.php/Home/Index/classList/id/<?php echo ($coursecate['id']); ?>.html"><?php echo ($coursecate['cname']); ?></a></li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
	</ul>	
</div>
	
<div class="course_content">
	<div class="course_list">
		<ul>
			<?php if(is_array($classList)): $i = 0; $__LIST__ = $classList;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$classlist): $mod = ($i % 2 );++$i;?><!--循环遍历班级名-->					
			<li id = <?php echo ($classlist['id']); ?>>
				<div class="course_all">
					<div class="hover_title"><span>共<b style="color: #94373D;">10</b>项目</span></div>	
					<div class="course_img">
						<a href="/jiaolianyuan/index.php/Home/Detail/detail/id/<?php echo ($classlist['id']); ?>.html"><img src="/jiaolianyuan/Public/images/<?php echo ($classlist['classpic']); ?>"width="262" height="171" alt="courseImg" /></a>
					</div>
					<div class="course_word">
						<dl>
							<dt><strong><?php echo ($classlist['classname']); ?></strong></dt>
							<dd class="price"><strong>￥<span><?php echo ($classlist[classprice]); ?></span></strong></dd>
						</dl>
					</div>
				</div>
			</li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
		</ul>
	</div>
</div>
<!--分页-->
<?php echo ($classListPage); ?>   
	
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