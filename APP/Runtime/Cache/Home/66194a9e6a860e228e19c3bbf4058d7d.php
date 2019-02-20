<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-教练选择</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/select_coach.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/select-coach.js"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
</head>

<body>
<!--导航栏-->
<div class="top-warp">
	<div class="top">
		<a class="logo" href="/jiaolianyuan/index.php/Home/Index/index.html">教练缘，企业人才定制与自学平台</a>
		<?php if(($name != '') OR ($phone != '')): ?><div class="card-warp">
			 	<img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" >
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
<!--教练的选择界面-->
<div id="select_coach">
    <h2>请选择您的指导教练：</h2><!--<span><?php echo ($className[0]['classname']); ?></span>-->
    <ul class="coach_list " id="vertical">
        <form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/index.php/Home/Detail/payMoney">
			<?php if(is_array($coaches)): $i = 0; $__LIST__ = $coaches;if( count($__LIST__)==0 ) : echo "暂无教练" ;else: foreach($__LIST__ as $key=>$coaches): $mod = ($i % 2 );++$i;?><li>
	              	<div id="info" >
	              		<img src="/jiaolianyuan/Public/images/<?php echo ($coaches['face']); ?>" alt="" width="162" height="162" />
			            <div class="info">
			                <ul>
			                    <li><?php echo ($coaches['tname']); ?></li>
			                    <li>简介:<?php echo ($coaches['tintro']); ?></li>
			                    <li><a href="/jiaolianyuan/index.php/Home/Detail/coachDetail/id/<?php echo ($coaches['id']); ?>.html">查看教练详情</a></li>
			                </ul>
			            </div>
	              	</div>
	                <h3><?php echo ($coaches['tname']); ?> <span>教练</span></h3>
	                <p>指导服务费:￥<?php echo ($coaches['coachprice']); ?></p>
	                <p>指导时间:20 天</p>
	               	<a  href="/jiaolianyuan/index.php/Home/Pay/payCenter/classId/<?php echo ($className[0]['id']); ?>/coach/<?php echo ($coaches['id']); ?>.html"><input class="button" type="" value="选择此教练"/></a>
	            </li><?php endforeach; endif; else: echo "暂无教练" ;endif; ?>
       </form>
    </ul>
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