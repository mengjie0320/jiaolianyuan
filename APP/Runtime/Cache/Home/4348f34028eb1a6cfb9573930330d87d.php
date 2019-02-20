<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-订单详情</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/personal.css" rel="stylesheet"/>
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
<!--自学流程图-->
<div class="main">
<!--侧边栏的信息-->
	<div class="main_left" id="main-left">
	    <ul class="content_list">
	    	<li>
	    		<img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" alt="用户头像"/>
	    		<span>账户余额:<strong>￥<?php echo ($studentBasicInfo[0]['account']); ?></span></strong>
	    	</li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/personal.html">我的通知</a></li>
	        <li  class="select"><a href="#">我的订单</a></li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/student.html">自学中心</a></li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/setting.html">账号设置</a></li> 
	    </ul>
	</div>
	<div class="main_right order">
      <ul>
		<!--循环遍历课程名-->
			<?php if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$orderList): $mod = ($i % 2 );++$i;?><li>
				<!--只选了班级-->
				<?php if(($orderList['classprice'] != '' AND $orderList['teacherprice'] == '')): ?><img src="/jiaolianyuan/Public/images/<?php echo ($orderList['classpic']); ?>" />
					<p>订单号:<?php echo ($orderList['no']); ?></p>
					<p>班级名字:<?php echo ($orderList['classname']); ?></p>
					<p>班级价格:￥<?php echo ($orderList['classprice']); ?></p>
					<p>总额:￥<?php echo ($orderList['classprice']); ?></p>
					<p>订单生成时间:<?php echo ($orderList['time']); ?></p>
					<?php if(($orderList['status'] == '0' )): ?><span>操作:</span><a href ="#" style="text-decoration: none;"><span>确认付款</span></a><?php endif; ?>
					<?php if(($orderList['status'] == '1' )): ?><span>状态:</span><span style="color: #3EF012;">已完成</span><?php endif; endif; ?>
				<!--只选了教练-->
				<?php if(($orderList['classprice'] == '' AND $orderList['teacherprice'] != '')): ?><img src="/jiaolianyuan/Public/images/<?php echo ($orderList['classpic']); ?>" />
					<p>订单号:<?php echo ($orderList['no']); ?></p>
					<p>班级名字:<?php echo ($orderList['classname']); ?></p>
					<p>教练名字:<?php echo ($orderList['tname']); ?></p>
					<p>教练价格:￥<?php echo ($orderList['teacherprice']); ?></p>
					<p>总额:￥<?php echo ($orderList['teacherprice']); ?></p>
					<p>订单生成时间:<?php echo ($orderList['time']); ?></p>
					<?php if(($orderList['status'] == '0' )): ?><span>操作:</span><a href ="#" style="text-decoration: none;"><span>确认付款</span></a><?php endif; ?>
					<?php if(($orderList['status'] == '1' )): ?><span>状态:</span><span style="color: #3EF012;">已完成</span><?php endif; endif; ?>
				</li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
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