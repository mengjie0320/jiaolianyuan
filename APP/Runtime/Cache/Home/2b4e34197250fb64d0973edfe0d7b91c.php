<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-教练中心</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/student2.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>

</head>
<script>
	window.onload = function(){
		var go_class = document.referrer ;
        $("#go_class").attr("href",go_class);
	};
	</script>
<body>
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
<!--<div class="lear-warp">
	<div class="lear">
		
	</div>
</div>-->
<!--主要内容-->
<div id="main">
	<!--内容的左边栏-->
	<div class="main_left">
    	<ul class="content_list">
            <li id="items"  class="select"><a href="#">实践项目</a></li>
            <li id="coach"><a href="#">咨询教练</a></li>
        </ul>
    </div>

    <!--内容右边班级的信息-->
    <div class="main_right">
	    <ul class="breadcrumb">
			<li><a  href="/jiaolianyuan/index.php/Home/Student/student.html">班  级</a></li><i></i>
			<li><a  href="#"><?php echo ($className); ?></a></li>
  		</ul>
	    <!--项目信息部分-->
	    <div id="item_content">
	    	<div id="item_content_bg">
	    		<?php if(($projectStatus['done'])): ?><span>已完成：</span>
					<?php if(is_array($projectStatus['done'])): $i = 0; $__LIST__ = $projectStatus['done'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['done']): $mod = ($i % 2 );++$i;?><div>
		                    <img src="/jiaolianyuan/Public/images/student-center-img/finish.png" alt=""/>
		                    <h3 class="finish"><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['done']['id']); ?>.html"><?php echo ($projectStatus['done']['name']); ?></a></h3>
		                    <b><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['done']['id']); ?>.html">
		                    	<img src="/jiaolianyuan/Public/images/student-center-img/button_finish.png" alt=""/>
		                    </a></b>
		                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>   
	            <br> 
	            <?php if(($projectStatus['bactive'])): ?><span>正在：</span>
					<?php if(is_array($projectStatus['bactive'])): $i = 0; $__LIST__ = $projectStatus['bactive'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['bactive']): $mod = ($i % 2 );++$i;?><div>
		                    <img src="/jiaolianyuan/Public/images/student-center-img/geting.png" alt=""/>
		                    <h3 class="finish"><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['bactive']['id']); ?>.html"><?php echo ($projectStatus['bactive']['name']); ?></a></h3>
		                    <b><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['bactive']['id']); ?>.html">
		                    	<img src="/jiaolianyuan/Public/images/student-center-img/button_geting.png" alt=""/>
		                    </a></b>
		                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>   
	            <br>
	    		<?php if((!$projectStatus['unsubmited'])): else: ?>
	        		<span>正在：</span>
	                <div class="doing_item" >
	                    <!--<img src="/jiaolianyuan/Public/images/student-center-img/blue.png" alt="正在进行图标"/>
	                    <h3><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($doingProjet[0]['id']); ?>"><?php echo ($unsubmitedProject[0]['name']); ?></a></h3>
	                    
	                    condition="($projectStatus['unsubmited'][0]['declinetime'] neq '0')"-->
	                    <!--倒计时有待跟时间比较-->
					    <?php if(($projectStatus['unsubmited'][0]['overtime']) ): ?><img src="/jiaolianyuan/Public/images/student-center-img/would.png" alt="时间到图标"/>
	                        <h3><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['unsubmited'][0]['id']); ?>.html"><?php echo ($projectStatus['unsubmited'][0]['name']); ?></a></h3>
	                        <a href="#">
	                        	<img src="/jiaolianyuan/Public/images/student-center-img/button_would.png" alt="时间到图标"/>
	                        </a>
					    <?php else: ?>
					    	<img src="/jiaolianyuan/Public/images/student-center-img/ing.png" alt="正在进行图标"/>
	                        <h3><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['unsubmited'][0]['id']); ?>.html"><?php echo ($projectStatus['unsubmited'][0]['name']); ?></a></h3>
					    	<a href="#">
					    		<img src="/jiaolianyuan/Public/images/student-center-img/button_ing.png" alt="正在进行图标"/>
					    	</a><?php endif; ?>
	                </div><?php endif; ?>
	            <br>
	            <?php if(($projectStatus['audit'])): ?><span>正在：</span>
					<?php if(is_array($projectStatus['audit'])): $i = 0; $__LIST__ = $projectStatus['audit'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['audit']): $mod = ($i % 2 );++$i;?><div>
		                    <img src="/jiaolianyuan/Public/images/student-center-img/waiting.png" alt=""/>
		                    <h3 class="finish"><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['audit']['id']); ?>.html"><?php echo ($projectStatus['audit']['name']); ?></a></h3>
		                    <b><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['audit']['id']); ?>.html">
		                    <img src="/jiaolianyuan/Public/images/student-center-img/button_waiting.png" alt=""/></a></b>
		                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	            <br>
	            <?php if(($projectStatus['notpass'])): ?><span>正在：</span>
					<?php if(is_array($projectStatus['notpass'])): $i = 0; $__LIST__ = $projectStatus['notpass'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectStatus['notpass']): $mod = ($i % 2 );++$i;?><div>
		                    <img src="/jiaolianyuan/Public/images/student-center-img/unpass.png" alt=""/>
		                    <h3 class="finish"><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['notpass']['id']); ?>.html"><?php echo ($projectStatus['notpass']['name']); ?></a></h3>
		                    <b><a href="/jiaolianyuan/index.php/Home/Student/projectDetail/projectId/<?php echo ($projectStatus['notpass']['id']); ?>.html">
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
		    <!--内容右边教练部分-->
		    <article>
			    <div class="ques" id="ques">
			        <ul class="coach_list">
						<!--学员已选的教练列表-->
                        <?php if(($coachesList2[0]['coachprice'] == '')): if(is_array($coachesList2)): $i = 0; $__LIST__ = $coachesList2;if( count($__LIST__)==0 ) : echo "您暂无教练" ;else: foreach($__LIST__ as $key=>$coachesList2): $mod = ($i % 2 );++$i;?><li>
					                <!--<a href="/jiaolianyuan/index.php/Home/Index2/index2/id/1/identity/student">-->
					                <!--<a href="#">-->
					                <a href="/jiaolianyuan/index.php/Home/Index2/index2/room_id/<?php echo ($coachesList2['id']); ?>.html">
					                    <img src="/jiaolianyuan/Public/images/<?php echo ($coachesList2['face']); ?>" alt=""/>                 
					                    <h2><?php echo ($coachesList2['tname']); ?></h2>
					                    <p><?php echo ($coachesList2['onlinetime']); ?></p>
					                </a>
					            </li><?php endforeach; endif; else: echo "您暂无教练" ;endif; endif; ?>
			        </ul>
			            <!--学员在该班级没有选择，列出可选择的教练-->
			            <ul class="coach_list" id="vertical">
			            <?php if(($coachesList2[0]['coachprice'] != '')): ?><p  class="tip">您在此班级没有选教练，您可以从以下教练中选择:</p>
			            	<?php if(is_array($coachesList2)): $i = 0; $__LIST__ = $coachesList2;if( count($__LIST__)==0 ) : echo "您暂无教练" ;else: foreach($__LIST__ as $key=>$coachesList2): $mod = ($i % 2 );++$i;?><li>
			                	<div id="info">
			                		<img src="/jiaolianyuan/Public/images/<?php echo ($coachesList2['face']); ?>" alt="" width="162" height="162" />
						            <div class="info">
						                <ul>
						                	<li><?php echo ($coachesList2['tname']); ?></li>
						                    <li>简介：<?php echo ($coachesList2['tintro']); ?></li>
						                     <li><a href="/jiaolianyuan/index.php/Home/Detail/coachDetail/id/<?php echo ($coachesList2['id']); ?>.html">查看教练详情</a></li>
						                </ul>	
						            </div>
						      	</div>
						      	<h2><?php echo ($coachesList2['tname']); ?> <span>教练</span></h2>
								<p>服务咨询费：￥<?php echo ($coachesList2['coachprice']); ?></p>
								<?php if(($coachesList2['sex'] == '0')): ?><if condition ="($coachesList2['sex'] eq '0')"> <p>性别:男</p><?php endif; ?>
	                            	<?php if(($coachesList2['sex'] == '1')): ?><p>性别:女</p><?php endif; ?>
	                            </p>
	                            <a  href="/jiaolianyuan/index.php/Home/Pay/payCenter/classId/<?php echo ($coachesList2['classid']); ?>/coach/<?php echo ($coachesList2['id']); ?>.html">
				                    <input class="button" type="" value="选择此教练"/>
				                </a>
				            </li><?php endforeach; endif; else: echo "您暂无教练" ;endif; endif; ?>
			        </ul>
			    </div>
			</article>
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
<script type="text/javascript" src="/jiaolianyuan/Public/js/student2.js"></script>
</body>
</html>