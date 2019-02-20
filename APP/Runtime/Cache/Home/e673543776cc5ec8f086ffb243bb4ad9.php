<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-班级详情</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/detail.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js" ></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/detail.js"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/scroll.js"></script>
	<script type="text/javascript">
//$(function(){
//	$('.move-list li:even').addClass('lieven');
//	
//	$("div.move-list").myScroll({
//		speed:40, //数值越大，速度越慢
//		rowHeight:56 //li的高度
//	});
//	
//})
</script>
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

<!--班级的详情-->
<div id="class_detail_warp">
	<div id="class_detail">
	    <?php if(($classBasicInfo[0]['classpic'] == '')): ?><img src="/jiaolianyuan/Public/images/student/nopic.png" alt="班级图片" width="585" height="324" /><?php endif; ?>
	    <?php if(($classBasicInfo[0]['classpic'] != '')): ?><img src="/jiaolianyuan/Public/images/<?php echo ($classBasicInfo[0]['classpic']); ?>" alt="班级图片" width="585" height="324" /><?php endif; ?>
       		<h2><?php echo ($classBasicInfo[0]['classname']); ?></h2>
        <p>
        	<h3 class="period">平均学习周期：<?php echo ($classBasicInfo[0]['aveperiod']); ?>天</h3>
        <!--<span>班级价格:<?php echo ($classBasicInfo[0]['classprice']); ?>元</span>-->
         	<h3 class="item_num">实践项目个数：<span><?php echo count($ProjectInfo) ?></span></h3>
        	<h3 class="class_price">班级价格：<span class="price">￥<?php echo ($classBasicInfo[0]['classprice']); ?> 元</span></h3>
        <!--<span>班级价格:<?php echo ($classBasicInfo[0]['classprice']); ?>元</span>
        <span>实战项目个数:<?php echo count($ProjectInfo) ?></span>-->
        </p>
         <!--如果是学生则按钮显示立即参加，若为教练，则显示申请成为教练-->
          <!--学生未选该班级且班级价格不为0-->
        <?php if(($identity != '' AND $ifSelect == '400') AND ($identity == 'student')): ?><a href="/jiaolianyuan/index.php/Home/Pay/payCenter/classId/<?php echo ($classBasicInfo[0]['id']); ?>.html">立即参加</a><?php endif; ?>
         
         <!--学生未选该班级且班级价格为0-->
        <?php if(($identity != '' AND $ifSelect == '400') AND ($identity == 'student') AND ($classBasicInfo[0]['classprice'] == '0')): ?><a  onclick="confirm('此班级为免费,点击马上参加即可选择该班级')?location.href='/jiaolianyuan/index.php/Home/Pay/freePay/id/<?php echo ($classBasicInfo[0]['id']); ?>.html':''" href="javascript:;">马上参加</a><?php endif; ?>
          <!--学生已选该班级-->  <!--学生已选该班级-->
        <?php if(($identity != '' AND $ifSelect == '200') AND ($identity == 'student')): ?><a href="/jiaolianyuan/index.php/Home/Student/student2/classId/<?php echo ($classBasicInfo[0]['id']); ?>.html">进入班级</a><?php endif; ?>
        
        <!--教练登录-->
        <?php if(($identity != '') AND ($identity == 'teacher')): ?><a href="/jiaolianyuan/index.php/Home/Coach/coachProve/id/<?php echo ($classBasicInfo[0]['id']); ?>.html">申请成为教练</a><?php endif; ?>
        
        <!--如果是游客？ ？  ？-->
        <?php if(($identity == '')): ?><a href="/jiaolianyuan/index.php/Home/Detail/selectCoach/id/<?php echo ($classBasicInfo[0]['id']); ?>.html">立即参加</a><?php endif; ?>
    </div>
</div>

<!--班级介绍-->
<div id="class_intro_warp">
	<div id="class_intro">
    	<h3>班级介绍：</h3>
    	<p><?php echo ($classBasicInfo[0]['classintro']); ?></p>
    </div>
</div>

<!--班级其他信息-->
<div id="class_oth">
	<div id="learn_req">
    	<div class="notice-tit" id="notice-tit">
    		<ul>
    			<li class="select"><a href="javascript:;">实践项目</a></li>
    			<li><a href="javascript:;">学习成果</a></li>
    		</ul>
    	</div>
    	<div class="notice-child" id="notice-child">
    		<div class="notice_con" style="display: block;">
    			<ul>
					<?php if(is_array($ProjectInfo)): $i = 0; $__LIST__ = $ProjectInfo;if( count($__LIST__)==0 ) : echo "此班级暂无项目" ;else: foreach($__LIST__ as $key=>$ProjectInfo): $mod = ($i % 2 );++$i;?><li id="<?php echo ($ProjectInfo['id']); ?>" class="show-div"><a href="javascript:;">
		    				<?php echo (html_entity_decode($ProjectInfo['name'])); ?></a>
		    			</li><?php endforeach; endif; else: echo "此班级暂无项目" ;endif; ?>
    			</ul>
    		</div>
    		<div class="notice_con" style="display: none;">
    			<ul>
    				<li><a href="javascript:;">暂无</a></li>
    			</ul>
    		</div>
    	</div>
		<?php if(is_array($ProjectInfo2)): $i = 0; $__LIST__ = $ProjectInfo2;if( count($__LIST__)==0 ) : echo "无项目简介" ;else: foreach($__LIST__ as $key=>$ProjectInfo2): $mod = ($i % 2 );++$i;?><div id="display<?php echo ($ProjectInfo2['id']); ?>" class="show-box">
				<div  class="heading_title">
					<span><?php echo (html_entity_decode($ProjectInfo2['name'])); ?></span><a href="#" class="close"></a>
				</div>
				<div class="main-content">
					<p><?php echo (html_entity_decode($ProjectInfo2['sense'])); ?></p>
				</div>
			</div><?php endforeach; endif; else: echo "无项目简介" ;endif; ?>
		<div id="cover"></div>
    </div>
    <div id="side_bar">
    	<div id="class_eval">
        	<h4>评价</h4>
        	<div class="move-list">
        		<ul class="eval_list">
            	<!--循环遍历评论的数据,目前有姓名，头像-->
				    <?php if(is_array($contentData)): $i = 0; $__LIST__ = $contentData;if( count($__LIST__)==0 ) : echo "暂无评论" ;else: foreach($__LIST__ as $key=>$contentData): $mod = ($i % 2 );++$i;?><li>
		                    <a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($contentData['face']); ?>" height="28" width="28"alt=""/></a>
		                    <span class="user_name"><?php echo ($contentData['stuname']); ?></span><span class="date"><?php echo ($contentData['time']); ?></span>
		                    <p class="star"><?php for($i=0;$i<$contentData['star'];$i++){echo "☆";}?></p>
		                    <p class="eval_txt"><?php echo ($contentData['content']); ?></p>
		                </li><?php endforeach; endif; else: echo "暂无评论" ;endif; ?>
            	</ul>
        	</div>
        </div>
        <div id="class_num">
        	<h4><?php echo count($studentData2);?>人在选择该班级</h4>
        	<div id="wai_box">
			<div class="zzsc_box">	
            <ul class="user_list">
			    <?php if(is_array($studentData2)): $i = 0; $__LIST__ = array_slice($studentData2,0,12,true);if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$more): $mod = ($i % 2 );++$i;?><!--循环遍历第二个框的姓名，头像-->
	            	<li>
	                    <a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($more['face']); ?>" width="54" height="54" alt=""/></a>
	                    <span class="user_name"><?php echo ($more['stuname']); ?></span>
	                </li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </ul>
            <ul class="user_list">
			   	<?php if(is_array($studentData2)): $i = 0; $__LIST__ = array_slice($studentData2,0,12,true);if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$more): $mod = ($i % 2 );++$i;?><!--循环遍历第二个框的姓名，头像-->
	            	<li>
	                    <a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($more['face']); ?>" width="54" height="54" alt=""/></a>
	                    <span class="user_name"><?php echo ($more['stuname']); ?></span>
	                </li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
              
            </ul>
            <ul class="user_list">
				<?php if(is_array($studentData2)): $i = 0; $__LIST__ = array_slice($studentData2,0,12,true);if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$more): $mod = ($i % 2 );++$i;?><!--循环遍历第二个框的姓名，头像-->
	            	<li>
	                    <a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($more['face']); ?>" width="54" height="54" alt=""/></a>
	                    <span class="user_name"><?php echo ($more['stuname']); ?></span>
	                </li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </ul>
           </div>
        </div>
           	<a class="pre"></a>
            <a class="next"></a>
			<div class="nav">
				<a class="now"></a>
				<a ></a>
				<a ></a>
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

</body>
</html>