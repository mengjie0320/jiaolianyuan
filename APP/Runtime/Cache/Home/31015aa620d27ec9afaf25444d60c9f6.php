<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="教练缘，教练，课程">
<meta name="description" content="教练缘为你量身订制教练学IT!">
<title>教练缘-教练中心</title>
<link href="/jiaolianyuan/Public/CSS/project.css" rel="stylesheet"/>
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
            <li class="select"><a href="#">实践项目</a></li>
            <li><a href="#">教练列表</a></li>
        </ul>
    </div>

    <!--内容右边班级的信息-->
    <div class="main_right">
	    <ul class="breadcrumb">
      		<li><a  href="#">自学中心</a><em></em></li>
			<li><a  href="#">班级</a></li>
			<li><a  href="#">PHP班</a></li>
  		</ul>
	    <!--项目信息部分-->
	    <div id="item_content">
	    	<div id="item_content_bg">
	    		<?php if(($projectStatus['done'])): ?><span>已完成：</span>
					<?php if(is_array($projectStatus['done'])): $i = 0; $__LIST__ = $projectStatus['done'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['done']): $mod = ($i % 2 );++$i;?><div>
		                    <img src="/jiaolianyuan/Public/images/student-center-img/finish.png" alt=""/>
		                    <h3 class="finish"><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['done']['id']); ?>.html"><?php echo ($projectStatus['done']['name']); ?></a></h3>
		                    <b><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['done']['id']); ?>.html">
		                    	<img src="/jiaolianyuan/Public/images/student-center-img/button_finish.png" alt=""/>
		                    </a></b>
		                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>   
	            <br> 
	            <?php if(($projectStatus['bactive'])): ?><span>正在：</span>
					<?php if(is_array($projectStatus['bactive'])): $i = 0; $__LIST__ = $projectStatus['bactive'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['bactive']): $mod = ($i % 2 );++$i;?><div>
		                    <img src="/jiaolianyuan/Public/images/student-center-img/geting.png" alt=""/>
		                    <h3 class="finish"><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['bactive']['id']); ?>.html"><?php echo ($projectStatus['bactive']['name']); ?></a></h3>
		                    <b><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['bactive']['id']); ?>.html">
		                    	<img src="/jiaolianyuan/Public/images/student-center-img/button_geting.png" alt=""/>
		                    </a></b>
		                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>   
	            <br>
	    		<?php if((!$projectStatus['unsubmited'])): else: ?>
	        		<span>正在：</span>
	                <div class="doing_item" >
	                    <!--<img src="/jiaolianyuan/Public/images/student-center-img/blue.png" alt="正在进行图标"/>
	                    <h3><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($doingProjet[0]['id']); ?>"><?php echo ($unsubmitedProject[0]['name']); ?></a></h3>
	                    
	                    condition="($projectStatus['unsubmited'][0]['declinetime'] neq '0')"-->
	                    <!--倒计时有待跟时间比较-->
					    <?php if(($projectStatus['unsubmited'][0]['overtime']) ): ?><img src="/jiaolianyuan/Public/images/student-center-img/would.png" alt="时间到图标"/>
	                        <h3><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['unsubmited'][0]['id']); ?>.html"><?php echo ($projectStatus['unsubmited'][0]['name']); ?></a></h3>
	                        <a href="#">
	                        	<img src="/jiaolianyuan/Public/images/student-center-img/button_would.png" alt="时间到图标"/>
	                        </a>
					    <?php else: ?>
					    	<img src="/jiaolianyuan/Public/images/student-center-img/ing.png" alt="正在进行图标"/>
	                        <h3><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['unsubmited'][0]['id']); ?>.html"><?php echo ($projectStatus['unsubmited'][0]['name']); ?></a></h3>
					    	<a href="#">
					    		<img src="/jiaolianyuan/Public/images/student-center-img/button_ing.png" alt="正在进行图标"/>
					    	</a><?php endif; ?>
					    
					   <!--<?php if(($unsubmitedProject[0]['message'] == 'doing')): ?><a href="#" >提交作业</a><?php endif; ?>
					   <?php if(($unsubmitedProject[0]['message'] == 'beclaim')): ?><a href="#" >领取新项目</a><?php endif; ?>-->
	                </div><?php endif; ?>
	            <br>
	            <?php if(($projectStatus['audit'])): ?><span>正在：</span>
						<?php if(is_array($projectStatus['audit'])): $i = 0; $__LIST__ = $projectStatus['audit'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['audit']): $mod = ($i % 2 );++$i;?><div>
			                    <img src="/jiaolianyuan/Public/images/student-center-img/waiting.png" alt=""/>
			                    <h3 class="finish"><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['audit']['id']); ?>.html"><?php echo ($projectStatus['audit']['name']); ?></a></h3>
			                    <b><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['audit']['id']); ?>.html">
			                    <img src="/jiaolianyuan/Public/images/student-center-img/button_waiting.png" alt=""/></a></b>
			                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	            <br>
	            <?php if(($projectStatus['notpass'])): ?><span>正在：</span>
					<?php if(is_array($projectStatus['notpass'])): $i = 0; $__LIST__ = $projectStatus['notpass'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['notpass']): $mod = ($i % 2 );++$i;?><div>
		                    <img src="/jiaolianyuan/Public/images/student-center-img/unpass.png" alt=""/>
		                    <h3 class="finish"><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['notpass']['id']); ?>.html"><?php echo ($projectStatus['notpass']['name']); ?></a></h3>
		                    <b><a href="/jiaolianyuan/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['notpass']['id']); ?>.html">
		                    <img src="/jiaolianyuan/Public/images/student-center-img/button_unpass.png" alt=""/></a></b>
		                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	            <br>
	            <!--已完成-->
	             
	            <?php if(($projectStatus['activation'])): ?><!--未完成-->
	            <span>未完成</span>
					<?php if(is_array($projectStatus['activation'])): $i = 0; $__LIST__ = $projectStatus['activation'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['activation']): $mod = ($i % 2 );++$i;?><div>
	                        <img src="/jiaolianyuan/Public/images/student-center-img/unfinish.png" alt=""/>
		                    <h3 class="not_finish"><a href="#"><?php echo ($projectStatus['activation']['name']); ?></a></h3>
		                    <!--<b><a href="#"></a></b>-->
		                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		    </div>
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
<script type="text/javascript" src="/jiaolianyuan/Public/js/project.js"></script>
</body>
</html>