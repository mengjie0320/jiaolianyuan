<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-学员个人中心</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/personal.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/threeconnect.js"></script>
	
	</head>
<body>
	<p><?php echo ($studentBasicInfo[0]['tintro']); ?></p>
<!--导航栏-->
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
			</div><?php endif; ?>  
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
<!--用户信息栏-->
<!--<div id="user_warp">	
	<div class="user">
    	<a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" alt="用户头像"/></a>
    	<span><?php echo ($name); ?></span>
        <p class="school"><?php echo ($studentBasicInfo[0]['school']); ?></p> 
        <p>账户余额:<span>￥<?php echo ($studentBasicInfo[0]['account']); ?></span></p> 
   </div>
</div>-->

<div class="main">
	<!--侧边栏的信息-->
	<div class="main_left" id="main-left">
	    <ul class="content_list">
	    	<li>
	    		<img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" alt="用户头像"/>
	    		<span>账户余额:<strong>￥<?php echo ($studentBasicInfo[0]['account']); ?></span></strong>
	    	</li>
	        <li><a href="#">我的通知</a></li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/order.html">我的订单</a></li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/student.html">自学中心</a></li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/setting.html">账号设置</a></li> 
	    </ul>
	</div>
<!--内容右边通知栏的信息-->
	<div class="main_right news" id="news">
	    <h2>通知栏</h2>
	    <div class="new_info">
	    	<ul>
			    <?php if(is_array($messageData)): $i = 0; $__LIST__ = $messageData;if( count($__LIST__)==0 ) : echo "您暂无消息" ;else: foreach($__LIST__ as $key=>$messageData): $mod = ($i % 2 );++$i;?><li >
		    			<div id="title<?php echo ($messageData['id']); ?>" class="system_time"><p><?php echo ($messageData['time']); ?></p></div>
		    		     <a href="javascript:;">
		        			<div class="backstate_info">
		        				<p><?php echo ($messageData['sendername']); ?>:<a href="/jiaolianyuan/index.php/Home/Student/messageDetail/id/<?php echo ($messageData['id']); ?>.html"><?php echo (html_entity_decode($messageData['content'])); ?></a></p>
		        			</div>
		    		     </a>
		    		</li><?php endforeach; endif; else: echo "您暂无消息" ;endif; ?>
	    	</ul>
	    </div>
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
<div id="mask"></div>
<script type="text/javascript" src="/jiaolianyuan/Public/js/personal.js"></script>
</body>
</html>