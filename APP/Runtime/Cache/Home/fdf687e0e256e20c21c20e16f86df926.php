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
<div class="main">
	<!--侧边栏的信息-->
	<div class="main_left" id="main-left">
	    <ul class="content_list">
	    	<li>
	    		<img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" alt="用户头像"/>
	    		<span>账户余额:<strong>￥<?php echo ($studentBasicInfo[0]['account']); ?></span></strong>
	    	</li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/personal.html">我的通知</a></li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/order.html">我的订单</a></li>
	        <li><a href="/jiaolianyuan/index.php/Home/Student/student.html">自学中心</a></li>
	        <li class="select"><a href="#">账号设置</a></li> 
	    </ul>
	</div>
 <!--账号信息的设置-->
	<div class="main_right set">
		<form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/index.php/Home/Student/change_info">
			<label class="tips_all tips_img">头像：</label>
			<div class="header_photo" id="imgdiv">
				<img id="pic" src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" width="120" height="120"/>
			</div>
			<div class="flies">
				<a href="javascript:void(0)" >更换头像
				<input  class="hide" type="file" accept="/jiaolianyuan/Public/images/*" value="yes" name="face" title="更换头像" id="upload"/>
				</a>
			</div>
			<!--<?php if(($studentBasicInfo[0]['stuname'] != '')): ?>-->
				<div class="set_realName">
				<label class="tips_all tips_realName">用户名：</label> <?php echo ($studentBasicInfo[0]['stuname']); ?>
			</div>
			<!--<?php else: ?>
			<div class="set_realName">
				<label class="tips_all tips_realName">姓名：</label>
				<input type="text" name="name" placeholder="真实姓名,只能修改一次，重名请添加任意字符" maxlength="16" />
			</div><?php endif; ?>-->
			<div class="set_sex">
				<label class="tips_all tips_sex">性别：</label>
				<label><input type="radio" name="sex" value="0"/ checked="checked">男</label>
				<label><input type="radio" name="sex" value="1"/>女</label>
			</div>
			<div class="set_password">
				<label class="tips_all tips_password">密码：</label>
				<a href="javascript:show()" id="change_password">修改密码</a>
				<div class="set_modal">
					<div class="modal_form" id="modal_form">
						<p>修改密码</p>
							<div class="origin_password">
								<label class="change_all" >输入原始密码：</label>
								<input class="same_input" type="password" name="oldpassword" value="" placeholder="输入原始密码" />
							</div>
							<div class="new_password">
								<label class="change_all">输入新密码：</label>
								<input class="same_input"  type="password" name="newpassword" value="" placeholder="输入新密码" />
							</div>
							<div class="second_password">
								<label class="change_all">再次输入新密码：</label>
								<input class="same_input"  type="password" name="checkpassword" value="" placeholder="再次输入新密码" />
							</div>
							<div class="save_btn">
								<label>
									<input type="submit" name="savepassword" value="确定" />
								</label>
							</div>
							<div class="reset_btn">
								<label>
									<input type="reset" name="reset" value="取消" onclick="hide()"/>
								</label>
							</div>
							<div class="close_btn">
								<a href="javascript:hide()"></a>
							</div>
					</div>
				</div>
			</div>
			<div class="set_city">
				<label class="tips_all tips_city">城市：</label>
			</div>
			<div class="set_introduce">
				<label class="tips_all tips_introduce">个人介绍：</label>
				<textarea placeholder="介绍一下自己吧！" name="tIntro"></textarea>
			</div>
			<div class="set_btn">
				<input type="submit" value="保存" name="btnSubmit" />
			</div>
		</form>
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