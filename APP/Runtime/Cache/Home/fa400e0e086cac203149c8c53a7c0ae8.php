<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-教练中心</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/project-detail.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/images/publiclogo.ico" rel="icon"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
</head>
<script>
	window.onload = function(){
		var go_project = document.referrer ;
        $("#go_project").attr("href",go_project);
	};
</script>
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
<div class="lear-warp">
	<div class="lear">
		<?php if(($ifSelectCoach == '400')): ?><p>温馨提示！若在自学的过程中遇到问题，可以选择 <a href="/jiaolianyuan/index.php/Home/Detail/selectCoach/id/<?php echo ($classId); ?>.html">教练</a>进行指导！</p><?php endif; ?>

	</div>
</div>
<!--主要内容-->
<div id="main">
	<!--内容的左边栏-->
	<div class="main_left">
    	<ul class="content_list">
            <li id="itemDetail" class="select"><a>项目详情</a></li>
            <li id="coach"><a href="#" >咨询教练</a></li>
        </ul>
    </div>
    <!--内容右边班级的信息-->
     <div class="main_right class">
        <!--<h2><a id="go_class" href="/jiaolianyuan/index.php/Home/Student/student" >个人中心</a><b></b><a id="go_class" href="/jiaolianyuan/index.php/Home/Student/student" >班级</a><b></b> <a id="go_project" href="#">项目</a><b></b>项目详情</h2>-->
      	<ul class="breadcrumb">
			<li><a id="go_class" href="/jiaolianyuan/index.php/Home/Student/student.html">班级</a></li><i></i>
			<li><a id="go_project" href="javascript:history.go(-1)"><?php echo ($className); ?></a></li><i></i>
			<li><a href="#">实践项目</a></li>
      	</ul>
        <!--项目的详情-->
        <div class="project_detail" id="project_detail">
	        <?php if(($proRes['unsubmited'][0][status] != '')): ?><div class="project_progress">
	              	<img src="/jiaolianyuan/Public/images/student-center-img/get_active.png" alt="领取项目"/><i>领取项目</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/ing_active.png" alt="进行中"/> <i href="#">进行中</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/upload_normal.png" alt="上传作业"/> <i href="#">上传作业</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/wait_normal.png" alt="等待批阅"/><i>等待批阅</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <!--需要一个灰色的批阅完成-->
	                <img src="/jiaolianyuan/Public/images/student-center-img/pass_normal.png" alt="批阅完成"/><i>批阅完成</i>
	            </div>
	        <?php elseif(($proRes['audit'][0][status] == '0')): ?>
		        <div class="project_progress">
	              	<img src="/jiaolianyuan/Public/images/student-center-img/get_active.png" alt="领取项目"/><i>领取项目</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/ing_active.png" alt="进行中"/> <i href="#">进行中</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/upload_active.png" alt="上传作业"/> <i href="#">上传作业</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/wait-_active.png" alt="等待批阅"/><i>等待批阅</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <!--需要一个灰色的批阅完成-->
	                <img src="/jiaolianyuan/Public/images/student-center-img/pass_normal.png" alt="批阅完成"/><i>批阅完成</i>
	            </div>
	        <?php elseif(($proRes['done'][0][status] == '1')): ?>
	            <div class="project_progress">
	              	<img src="/jiaolianyuan/Public/images/student-center-img/get_active.png" alt="领取项目"/><i>领取项目</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/ing_active.png" alt="进行中"/> <i href="#">进行中</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/upload_active.png" alt="上传作业"/> <i href="#">上传作业</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/wait_active.png" alt="等待批阅"/><i>等待批阅</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/passed.png" alt="批阅完成"/><i>批阅完成</i>
	            </div>
	        <?php elseif(($proRes['notpass'][0][status] == '2')): ?>
		        <div class="project_progress">
	              	<img src="/jiaolianyuan/Public/images/student-center-img/get_active.png" alt="领取项目"/><i>领取项目</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/ing_active.png" alt="进行中"/> <i href="#">进行中</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/upload_active.png" alt="上传作业"/> <i href="#">上传作业</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/wai_active.png" alt="等待批阅"/><i>等待批阅</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/unpassed.png" alt=""/><i>批阅未通过</i>
	            </div>
	        <?php elseif(($proRes['bactivate'][0][status] == '0')): ?>
	            <div class="project_progress">
	              	<img src="/jiaolianyuan/Public/images/student-center-img/get_normal.png" alt="领取项目"/><i>领取项目</i>
	                
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/ing_normal.png" alt="进行中"/> <i>进行中</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/upload_normal.png" alt="上传作业"/> <i>上传作业</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <img src="/jiaolianyuan/Public/images/student-center-img/wait_normal.png" alt="等待批阅"/><i>等待批阅</i>
	                <span class="dottedline"><img src="/jiaolianyuan/Public/images/student-center-img/dottedline.png" alt="虚线条"/></span>
	                <!--需要一个灰色的批阅完成-->
	                <img src="/jiaolianyuan/Public/images/student-center-img/pass_normal.png" alt="批阅完成"/><i>批阅完成</i>
	            </div>
	        <?php else: endif; ?>
            <ul class="project_mes">
				<?php if(is_array($projectInfo)): $i = 0; $__LIST__ = $projectInfo;if( count($__LIST__)==0 ) : echo "暂无班级" ;else: foreach($__LIST__ as $key=>$projectInfo): $mod = ($i % 2 );++$i;?><li>
	                	<h2>项目名称：<span><?php echo ($projectInfo['name']); ?></span></h2>
	                </li>
	            	<li>
	                	<h2>项目意义：<span><?php echo ($projectInfo['sense']); ?></span></h2>
	                </li>
	                <li>
	                	<h2>项目内容：<span><?php echo ($projectInfo['request']); ?></span></h2>
	                   
	                </li>
	                <li>
	                	<h2>要求时间：<span><?php echo ($projectInfo['requiretime']); ?>天</span></h2>
	                </li>
	                <li>
	                	<h2>相关资料：<span>相关资料请点击旁边按钮查看<a href="http://<?php echo ($projectInfo['dataurl']); ?>" target="_blank">链接</a></span></h2>
	                </li>
	                <?php if(($proRes['unsubmited'][0]['value1'])): ?><li>
	                	<h2>项目超时：<?php echo round($proRes['unsubmited'][0]['value2'],2); ?>小时 <br><?php echo ($proRes['unsubmited'][0]['message1']); ?></h2>
	                    </li>
	                <?php elseif(($proRes['unsubmited'][0]['value2'])): ?>
	                	<li>
	                	<h2>倒计时 : 项目还剩&nbsp;&nbsp;<?php echo round($proRes['unsubmited'][0]['value2'],2); ?>小时 &nbsp;&nbsp;<?php echo ($proRes['unsubmited'][0]['message2']); ?></h2>
	                    </li><?php endif; ?>
            	</ul><?php endforeach; endif; else: echo "暂无班级" ;endif; ?>
            <div class="project_detail">
	            <?php if(($proRes['unsubmited'][0][status] != '')): ?><div class="completion">
	            	<h2 class="help2">指南：</h2>
         		</div>  
         		<!--按钮部分-->
	        	<label class="upload" for="file">提交项目</label>
		        <form enctype="multipart/form-data" method="post" action="/jiaolianyuan/index.php/Home/Student/submitPro/projectid/<?php echo ($proRes['unsubmited'][0]['projectid']); ?>.html" >
		        	<input type="file" id = "file" name="project"  accept="/jiaolianyuan/Public/images/*" > <!--accept路径有待研究hidden=""-->
		        	<input type="submit" id="submit" name="submit" value="确认提交">
		        </form>
	        </div>
	        
            <?php elseif(($proRes['audit'][0]['status'] == '0')): ?>
        	<div class="completion">
        		<h2>请耐心审核通过</h2>  <br>
            </div>
            <?php elseif(($proRes['done'][0]['status'] == '1')): ?>
        	<div class="completion">
            	<h2>恭喜你，审核通过！</h2>  <br>
            	<span>&nbsp;&nbsp;&nbsp;&nbsp;等级为：<?php if(($proRes['done'][0]['rank'] == '0')): ?>A<?php endif; ?>
            		<?php if(($proRes['done'][0]['rank'] == '1')): ?>B<?php endif; ?>
            		<?php if(($proRes['done'][0]['rank'] == '2')): ?>C<?php endif; ?>
	            	<?php if(($proRes['done'][0]['rank'] == '3')): ?>D<?php endif; ?>
	            	<?php if(($proRes['done'][0]['rank'] == '4')): ?>E<?php endif; ?>
            	</span><br><br>
                <span class="eval">评语：<span><?php echo ($proRes['done'][0][remark]); ?></span></span>
            </div>
            <?php elseif(($proRes['notpass'][0]['status'] == '2')): ?>
        	<div class="completion">
            	<h2 class="not-pass">Sorry，审核未通过</h2>  <br>
                <span class="eval">评语：<p><?php echo ($proRes['notpass'][0]['remark']); ?></p></span>
                <form enctype="multipart/form-data" method="post" action="/jiaolianyuan/index.php/Home/Student/doagainPro/projectid/<?php echo ($proRes['notpass'][0]['projectid']); ?>.html" >
                	<input type = "submit" name="again" value="选择重新做">
                </form>
            </div>
            <?php elseif(($proRes['bactivate'][0]['status'] == '0')): ?>
            <div class="completion">
            	<h2>Sorry，你还没有申报项目！</h2>  <br>
                <span class="eval">评语：<p><?php echo ($workResult[0][remark]); ?></p></span>
	            <form enctype="multipart/form-data" method="post" action="/jiaolianyuan/index.php/Home/Student/getPro/projectid/<?php echo ($proRes['bactivate'][0]['projectid']); ?>.html" >
                	<input type = "submit" name="newpro" value="领取新项目">
                </form>
            </div>
	        <?php else: endif; ?>
        </div>
        </div>
     	<!--内容右边问答部分-->
	    <div class="ques" id="ques">
	        <ul class="coach_list">
				<!--循环遍历学员的教练列表-->
				<?php if(is_array($coachesList2)): $i = 0; $__LIST__ = $coachesList2;if( count($__LIST__)==0 ) : echo "您暂没有选择教练" ;else: foreach($__LIST__ as $key=>$coachesList2): $mod = ($i % 2 );++$i;?><li>
		                <!--<a href="#">-->
					 	<a href="/jiaolianyuan/index.php/Home/Index2/index2/room_id/<?php echo ($coachesList3['id']); ?>.html">
		                    <img src="/jiaolianyuan/Public/images/<?php echo ($coachesList2['face']); ?>" alt=""/>                 
		                    <h2><?php echo ($coachesList2['tname']); ?></h2>
		                    <p><?php echo ($coachesList2['onlinetime']); ?></p>
		                </a>
		            </li><?php endforeach; endif; else: echo "您暂没有选择教练" ;endif; ?>
	            <!--页码-->
	            <?php echo ($page); ?>
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
<script type="text/javascript" src="/jiaolianyuan/Public/js/projectDetail.js"></script>
</body>
</html>