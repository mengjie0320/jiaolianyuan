<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="教练缘，教练，课程">
<meta name="description" content="教练缘为你量身订制教练学IT!">
<title>教练缘-教练中心</title>
<link href="/jiaolianyuan/Public/CSS/choose-coach.css" rel="stylesheet"/>
<link href="/jiaolianyuan/Public/images/student-center-img/logo.ico" rel="icon"/>
<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>

</head>
<script>
	window.onload = function(){
		var go_class = document.referrer ;
        $("#go_class").attr("href",go_class);
	};
	</script>
<body>
<!--导航栏-->
<div id="top">
	<div id="nav">
        <a href="/jiaolianyuan/Home/Index/index.html"><img src="/jiaolianyuan/Public/images/student-center-img/logo.png" alt="教练缘" title="教练缘"/></a>
	        <ul id="nav_left">
	            <li><a href="/jiaolianyuan/Home/Index/index.html" target="_parent">首页</a></li>
	            <li><a href="#" target="_parent">帮助中心</a></li>
	              <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/Home/Coach/coach.html">个人中心</a></li><?php endif; ?>
				  <?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/Home/Student/student.html">自学中心</a></li><?php endif; ?>
				  <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/Home/Login/login.html" onclick="warn()">自学中心</a></li><?php endif; ?>       
	        </ul>
	        <ul id="nav_right">
	            <?php if(($name != '') OR ($phone != '')): ?><b><a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>"></a></b>
					 	<!--学员头像进入个人中心-->
					 	<?php if(($identity == 'student')): ?><p class="myp" id="myp">
						 	<a id="enterCenter" href="/jiaolianyuan/Home/Student/student.html"><?php echo ($name); ?></a>
						 	<span class="logout">
				 				<a href="/jiaolianyuan/Home/Login/logout">退出</a>
				 			</span>
				 			</p><?php endif; endif; ?>
	        </ul>
    </div>
</div>
<!--自学流程图-->
<div class="lear-warp">
	<div class="lear">
		
	</div>
</div>
<!--主要内容-->
<div id="main">
	<!--内容的左边栏-->
	<div class="main_left">
    	<ul class="content_list">
            <li><a href="/jiaolianyuan/Home/Student/student2/classId/<?php echo ($getClassList['id']); ?>.html">实践项目</a></li>
            <li class="select"><a href="/jiaolianyuan/Home/Student/chooseCoach.html">教练列表</a></li>
        </ul>
   </div>
   <!--内容右边教练部分-->
	<article>
	    <div class="ques" id="ques">
	    	<ul class="breadcrumb">
	      		<li><a  href="/jiaolianyuan/Home/Student/student.html">自学中心</a><i></i></li>
				<li><a  href="/jiaolianyuan/Home/Student/student.html">班级</a><i></i></li>
				<li><a  href="#">教练列表</a></li>
  			</ul>
	        <ul class="coach_list">
				<!--学员已选的教练列表-->
                <?php if(($coachesList2[0]['coachprice'] == '')): if(is_array($coachesList2)): $i = 0; $__LIST__ = $coachesList2;if( count($__LIST__)==0 ) : echo "您暂无教练" ;else: foreach($__LIST__ as $key=>$coachesList2): $mod = ($i % 2 );++$i;?><li>
			                <a href="/jiaolianyuan/Home/Index2/index2/room_id/<?php echo ($coachesList2['id']); ?>.html">
			                    <img src="/jiaolianyuan/Public/images/<?php echo ($coachesList2['face']); ?>" alt=""/>                 
			                    <h2><?php echo ($coachesList2['tname']); ?></h2>
			                    <p><?php echo ($coachesList2['onlinetime']); ?></p>
			                </a>
			            </li><?php endforeach; endif; else: echo "您暂无教练" ;endif; endif; ?>
	        </ul>
	            <!--学员在该班级没有选择，列出可选择的教练-->
	            <ul class="coach_list" id="vertical">
	            <?php if(($coachesList2[0]['coachprice'] != '')): ?><p  class="tip">您在此班级没有选教练，你可以从以下教练中选择:</p>
	            	<?php if(is_array($coachesList2)): $i = 0; $__LIST__ = $coachesList2;if( count($__LIST__)==0 ) : echo "您暂无教练" ;else: foreach($__LIST__ as $key=>$coachesList2): $mod = ($i % 2 );++$i;?><li>
		                <!--<a href="/jiaolianyuan/Home/Index2/index2/id/1/identity/student">-->
		                <!--<a href="#">-->
	                	<a id="info" href="/jiaolianyuan/Home/Pay/payCenter/classId/<?php echo ($coachesList2['classid']); ?>/coach/<?php echo ($coachesList2['id']); ?>.html">
	                		<img src="/jiaolianyuan/Public/images/<?php echo ($coachesList2['face']); ?>" alt="" width="162" height="162" />
				            <div class="info">
				                <ul>
				                	<li><?php echo ($coachesList2['tname']); ?></li>
				                    <li>简介：<?php echo ($coachesList2['tintro']); ?></li>
				                    <li>值班时间：<?php echo ($coachesList2['onlinetime']); ?></li>
				                </ul>	
				            </div>
				      	</a>
				      	<h2><?php echo ($coachesList2['tname']); ?> <span>教练</span></h2>
						<p>服务咨询费：￥<?php echo ($coachesList2['coachprice']); ?></p>
						<?php if(($coachesList2['sex'] == '0')): ?><if condition ="($coachesList2['sex'] eq '0')"> <p>性别:男</p><?php endif; ?>
                        	<?php if(($coachesList2['sex'] == '1')): ?><p>性别:女</p><?php endif; ?>
                        </p>
		                <!--<a href="/jiaolianyuan/Home/Pay/payCenter/classId/<?php echo ($coachesList2['classid']); ?>/coach/<?php echo ($coachesList2['tname']); ?>.html">
		                	
		                    <img src="/jiaolianyuan/Public/images/<?php echo ($coachesList2['face']); ?>" alt=""/>                 
		                    <h2><?php echo ($coachesList2['tname']); ?></h2>
		                    <p><?php echo ($coachesList2['onlinetime']); ?></p>
                            <?php if(($coachesList2['sex'] == '0')): ?><p>
                            	<if condition ="($coachesList2['sex'] eq '0')">性别:男<?php endif; ?>
                            	<?php if(($coachesList2['sex'] == '1')): ?>性别:女<?php endif; ?>
                            </p>
                            <p><?php echo ($coachesList2['tintro']); ?></p>
		                    <p>￥<?php echo ($coachesList2['coachprice']); ?></p>
		                </a>-->
		            </li><?php endforeach; endif; else: echo "您暂无教练" ;endif; endif; ?>
	        </ul>
	    </div>
	</article>
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
<script type="text/javascript" src="/jiaolianyuan/Public/js/project.js"></script>
</body>
</html>