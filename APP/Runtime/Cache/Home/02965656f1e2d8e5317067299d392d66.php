<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>教练缘-支付中心</title>
	<link rel="stylesheet" href="/jiaolianyuan/Public/CSS/common.css" />
	<link rel="stylesheet" href="/jiaolianyuan/Public/CSS/pay.css" />
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js" ></script>
</head>
<body>
<div class="top-warp">
	<div class="top">
		<a class="logo" href="/jiaolianyuan/index.php/Home/Index/index.html">教练缘，企业人才定制与自学平台</a>
		<?php if(($name != '') OR ($phone != '')): ?><div class="card-warp">
			 	<img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" >
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
<!--支付内容--->
<div class="center">
	<p>支付中心</p>
	<!--只选班级-->
	<?php if(($classInfo[0]['classname'] != '' AND $coachId == '')): ?><img src="/jiaolianyuan/Public/images/<?php echo ($classInfo[0]['classpic']); ?>" width="262" height="171" alt="centerImg"/>
		<p  class="word_name"><?php echo ($classInfo[0]['classname']); ?></p>
		<span class="class_price">班级价格:<strong>￥<?php echo ($classInfo[0]['classprice']); ?></strong></span><?php endif; ?>
	<!--只选择教练-->
	<?php if(($classInfo[0]['classname'] == '')): ?><img src="/jiaolianyuan/Public/images/<?php echo ($coachface['face']); ?>" width="162" height="162" alt="centerImg"/>
		<p class="word_name">教练名 : <strong><?php echo ($coachName); ?></strong></p>
		<span class="class_price">教练指导服务费 :<strong> ￥<?php echo ($coachprice); ?></strong></span><?php endif; ?>
</div>
<!--支付方式-->
<div class="pay_way">
	<p>支付方式</p>
	<div class="way_img">
		<form target="" method="">
			<label>
				<input type="radio" name="pay_way" checked="checked"><img src="/jiaolianyuan/Public/images/student/icon_wechat.png" alt="wayImg"/><span>微信支付</span>
			</label>
		</form>
	</div>
</div>
<!--结算-->
<div class="pay_count">
	<a class="return_scan" href="/jiaolianyuan/index.php/Home/Pay/detail/id/<?php echo ($classInfo[0]['id']); ?>.html">返回继续浏览</a>
	<p class="pay_price">应付金额：<strong >￥<?php echo ($sum); ?></strong></p>
	<a class="count_btn" href="#" id="pay"><input type="submit" value="去支付" onclick=" setTimeout('show()',200);"></a>
</div>

<!--支付模态框-->
<div class="set_modal">
	<div class="modal_form" id="modal_form">
    	 <div class="modal_word">
    	 	<p>支付<span style="color: red;"><?php echo ($sum); ?></span>元</p>
    	 </div>
    	 <div class="qrcode">
    	 	<p>微信扫一扫</p>
    	 	<img src="/jiaolianyuan/index.php/Home/Pay/qrcode" alt="二维码"/>
    	 	     <!--模拟付款按钮-->
    	 	     <!--正常流程-->
			     <?php if(($classInfo[0]['classname'] != '' AND $coachId != '')): ?><a  href="/jiaolianyuan/index.php/Home/Pay/payDeal/classId/<?php echo ($classInfo[0]['id']); ?>/coachId/<?php echo ($coachId); ?>.html"><input class="button" type="button" value="模拟付款"/></a><?php endif; ?>
    	         <!--只选班级-->
    	         <?php if(($classInfo[0]['classname'] != '' AND $coachId == '')): ?><a  href="/jiaolianyuan/index.php/Home/Pay/skipCoach/classId/<?php echo ($classInfo[0]['id']); ?>.html"><input class="button" type="button" value="模拟付款"/></a><?php endif; ?>
    	         <!--只选择教练-->
			     <?php if(($classInfo[0]['classname'] == '')): ?><a  href="/jiaolianyuan/index.php/Home/Pay/payCoachFare/classId/<?php echo ($classId); ?>/coachId/<?php echo ($coachId); ?>.html"><input class="button" type="button" value="模拟付款"/></a><?php endif; ?>	
    	 </div>
    	 <div class="close_btn">
    	 	<a onclick="hide()"></a>
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
<script type="text/javascript" src="/jiaolianyuan/Public/js/pay.js" ></script>
</body>
</html>