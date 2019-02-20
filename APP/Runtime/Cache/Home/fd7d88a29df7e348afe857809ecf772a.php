<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-教练认证</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/coachProve.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
</head>

<body>
<!--导航栏-->
<div id="top">
	<div id="nav">
        <a href="/jiaolianyuan/Home/Index/index.html"><img src="/jiaolianyuan/Public/images/public/logo.png" alt="教练缘" title="教练缘"/></a>
        <ul id="nav_left">
            <li><a href="/jiaolianyuan/Home/Index/index.html" target="_parent">首页</a></li>
            <li><a href="#" target="_parent">帮助中心</a></li>
            <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/Home/Coach/coach.html">个人中心</a></li><?php endif; ?>
		    <?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/Home/Student/student.html">个人中心</a></li><?php endif; ?>
	        <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/Home/Login/Login.html" onclick="warn()">个人中心</a></li><?php endif; ?>        </ul>
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
				 	<a id="enterCenter" href="/jiaolianyuan/Home/Student/student.html"><?php echo ($name); ?></a>
				 	<span class="logout">
		 				<a href="/jiaolianyuan/Home/Login/logout">退出</a>
		 			</span>
		 			</p><?php endif; ?>
			 <?php else: endif; ?>
        </ul>
    </div>
</div>
<div id="prove_mes">
	<h1><img src="/jiaolianyuan/Public/images/coachProve_img/coachProve.png" alt="教练认证图标"/>教练认证</h1>
    <h2>基本信息：</h2>
    	<form method="post" action="/jiaolianyuan/Home/Coach/do_coachProve" enctype="multipart/form-data" >
        	<label for="name">真实姓名 ： </label>
            <span>
                <input type="text" id="name" name="name" placeholder="请输入真实姓名..." required/>
            </span>
            <label for="phone">联系电话 : </label>
            <span>
           		<input type="tel" id="phone" name="phone" placeholder="请输入联系电话..." required/>
            </span>
            <label for="email">电子邮箱 : </label>
            <span>
           		<input type="email" id="email" name="email" placeholder="请输入电子邮箱..." required/>
            </span>
            <label for="IDnumber">身份证号 : </label>
            <span>
           		<input type="text" id="IDnumber" name="IDnumber" placeholder="请输入身份证号..." required/>
            </span>
            
              <label for="IDnumber">申请价格 : </label>
            <span>
           		<input type="text" id="IDnumber" name="coachPrice" placeholder="定价范围￥:<?php echo ($priceRange[0]['coachminprice']); ?>-<?php echo ($priceRange[0]['coachmaxprice']); ?>" required/>
            </span>
            
            <h2>申请信息：</h2>
            <label for="reason" id="reason">申请理由 : </label>
            	<p>
           			<textarea cols="45" rows="8" type="number" id="reason" name="reason" placeholder="请输入您的申请理由..." required></textarea>
            	</p>
            
            <input type="submit" id="submit"value="提交"/>
            <input type="reset" id="reset" value="重置"/>
        </form>
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
<script src="/jiaolianyuan/Public/js/html5shiv.js"></script>
</body>
</html>