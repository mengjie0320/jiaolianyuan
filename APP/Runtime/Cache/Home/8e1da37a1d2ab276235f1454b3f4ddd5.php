<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="教练缘，教练，课程">
<meta name="description" content="教练缘为你量身订制教练学IT!">
<title>教练缘-教练中心</title>
<link href="/jiaolianyuan/Public/CSS/student-center.css" rel="stylesheet"/>
<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
<link href="/jiaolianyuan/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/jiaolianyuan/Public/js/stucenter.js"></script>
<script type="text/javascript" src="/jiaolianyuan/Public/js/threeconnect.js"></script>
<script src="/jiaolianyuan/Public/js/uploadPreview.js" type="text/javascript"></script>
<script type="text/javascript" src="/jiaolianyuan/Public/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/jiaolianyuan/Public/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/jiaolianyuan/Public/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/jiaolianyuan/Public/umeditor/lang/zh-cn/zh-cn.js"></script>

</head>

<body>

<!--导航栏-->
<!--<div class="container">-->
<div id="top">
	<div id="nav">
        <a href="/jiaolianyuan/Home/Index/index.html"><img src="/jiaolianyuan/Public/images/public/logo.png" alt="教练缘" title="教练缘"/></a>
        <ul id="nav_left">
            <li><a href="/jiaolianyuan/Home/Index/index.html" target="_parent">首页</a></li>
            <li><a href="#" target="_parent">帮助中心</a></li>
              <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/Home/Coach/coach.html">个人中心</a></li><?php endif; ?>
			  <?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/Home/Student/student.html">个人中心</a></li><?php endif; ?>
			  <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/Home/Login/login.html" onclick="warn()">个人中心</a></li><?php endif; ?>       
        </ul>
        <!--  <div class="information">
        	<p>消息</p><img  src="/jiaolianyuan/Public/images/消息 (2).png"/><div class="red_dott"><span><?php echo ($unReadMsgNum); ?></span></div>       <!--这里要改-->
        <!--</div> -->
        <ul id="nav_right">
            <?php if(($name != '') OR ($phone != '')): ?><b><a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>"></a></b>
            	
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
<!--用户信息栏-->
<div id="user_warp">
	<div class="user">
    	<a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" alt="用户头像"/></a>
    	<span><?php echo ($name); ?></span>
        <p class="school"><?php echo ($coachBasicInfo[0]['address']); ?></p>
    </div>
</div>
<!--主要内容-->
<div id="main">
	<!--内容的左边栏-->
	<div class="main_left" >
    <div class="main-left" id="main-left">
        <ul class="content_list">
            <li class="select"><a href="#"><img src="/jiaolianyuan/Public/images/student-center-img/mes_detail.png" alt=""/>消息详情</a></li>
            
            <li><a href="/jiaolianyuan/Home/Coach/coach.html"><img src="/jiaolianyuan/Public/images/student-center-img/home.png" alt=""/>首页</a></li>
        </ul>
     </div>
    </div>
    <!--内容右边主页的信息-->
    <div class="left-tab" id="left-tab">
        <article style="display:block;">
        <div class="main_right home">
        <h2>消息详情</h2>
        <?php if(is_array($receiveMsg)): $i = 0; $__LIST__ = $receiveMsg;if( count($__LIST__)==0 ) : echo "您暂无消息" ;else: foreach($__LIST__ as $key=>$receiveMsg): $mod = ($i % 2 );++$i;?><!-- 学员 -->
    			<?php if($name == $receiveMsg['sendername'] ): ?><div class="talk">
						<div class="student_talk">
							<div class="stu_name">
								<img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" width="60" height="60"/>
								<p><?php echo ($receiveMsg['sendername']); ?></p><span><?php echo ($receiveMsg['time']); ?></span>
								<div class="stu_word">
									<p><?php echo (html_entity_decode($receiveMsg['content'])); ?></p>
								</div>
							</div>
						</div><?php endif; ?>
	           <!-- 教练 -->
				<?php if($name != $receiveMsg['sendername'] ): ?><div class="admin_talk">
						<div class="img_name">
						<div class="admin_img">
							<img src="/jiaolianyuan/Public/images/face/coach1.png" width="60" height="60"/>
						</div>
							<div class="admin_name">
							<p><?php echo ($receiveMsg['sendername']); ?></p><span><?php echo ($receiveMsg['time']); ?></span>
						</div>
						</div>
						<div class="admin_word">
							<p><?php echo (html_entity_decode($receiveMsg['content'])); ?></p>
						</div>
					</div><?php endif; endforeach; endif; else: echo "您暂无消息" ;endif; ?>
				<form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/Home/Coach/replay/id/<?php echo ($referId); ?>.html">
					<div class="creater">
						<script type="text/plain" name="content" id="myEditor" style="width:800px;height:180px;"></script>
					</div>
					
					
					        
					  <script type="text/javascript">
					//实例化编辑器
					var um = UM.getEditor('myEditor');
					um.addListener('blur',function(){
					    $('#focush2').html('编辑器失去焦点了')
					});
					um.addListener('focus',function(){
					    $('#focush2').html('')
					});
					//按钮的操作
					function insertHtml() {
					    var value = prompt('插入html代码', '');
					    um.execCommand('insertHtml', value)
					}
					</script>
					
					<div class="reply">
						<button type="submit" id="submit1" />发送</button>
					</div>
				</form>	    
    		</div> 
    	</div>

    </article>
    <!--内容右边班级的信息-->
    <article style="display:none;">
     <div class="main_right class">
        <h2>班级></h2>
        <div class="stu_list" id="stu-list">
        <ul class="item_list" style="display:block;">
			<?php if(is_array($getClassList)): $i = 0; $__LIST__ = $getClassList;if( count($__LIST__)==0 ) : echo "暂无班级" ;else: foreach($__LIST__ as $key=>$getClassList): $mod = ($i % 2 );++$i;?><li>
                <a href="/jiaolianyuan/Home/Coach/student2/classId/<?php echo ($getClassList['id']); ?>">
                    <img src="/jiaolianyuan/Public/images/<?php echo ($getClassList['classpic']); ?>" alt="班级头像" width="218" height="149"/>
                    <!--<img src="/jiaolianyuan/Public/images/student-center-img/item_pic/1.png" alt="班级头像"/>-->
                    <h3><?php echo ($getClassList['classname']); ?></h3>
                    <?php if(($getClassList['graduatestatus'] == '0')): ?><span>未毕业</span><?php endif; ?>
                    <?php if(($getClassList['graduatestatus'] == '1')): ?><span>已毕业</span><?php endif; ?>
                </a>
            </li><?php endforeach; endif; else: echo "暂无班级" ;endif; ?>
            <!--<li>
                <a href="">
                    <img src="/jiaolianyuan/Public/images/student-center-img/item_pic/2.png" alt="学员头像"/>
                    <h3>PHP基础班（有基础）</h3><span>(未毕业)</span>
                </a>
            </li>
            <li>
                <a href="">
                    <img src="/jiaolianyuan/Public/images/student-center-img/item_pic/3.png" alt="学员头像"/>
                    <h3>PHP基础班（有基础）</h3><span>(未毕业)</span>
                </a>
            </li>
            <li>
                <a href="">
                    <img src="/jiaolianyuan/Public/images/student-center-img/item_pic/4.png" alt="学员头像"/>
                    <h3>PHP基础班（有基础）</h3><span>(未毕业)</span>
                </a>
            </li>-->
        </ul>

        <div class="page">
            <a class="active" href="#">首页</a>
            <a href="#">上一页</a>
            <a class="active" href="#">1</a>
            <a href="#">2</a>
            <a href="#">...</a>
            <a href="#">5</a>
            <a href="#">下一页</a>
            <a href="#">尾页</a>
        </div>

     </article>
     <!--内容右边问答部分-->
     <article style="display:none;">
     <div class="main_right ques">
        <ul class="coach_list">
			
			
			<!--循环遍历学员的教练列表-->
			<?php if(is_array($coachesList)): $i = 0; $__LIST__ = $coachesList;if( count($__LIST__)==0 ) : echo "您暂无教练" ;else: foreach($__LIST__ as $key=>$coachesList): $mod = ($i % 2 );++$i;?><li>
                <a href="#">
                    <img src="/jiaolianyuan/Public/images/<?php echo ($coachesList['face']); ?>" alt=""/>                 
                    <h2><?php echo ($coachesList['tname']); ?></h2>
                    <p><?php echo ($coachesList['onlinetime']); ?></p>
                </a>
            </li><?php endforeach; endif; else: echo "您暂无教练" ;endif; ?>
            
            </ul>
            <div class="page">
                <a class="active" href="#">首页</a>
                <a href="#">上一页</a>
                <a class="active" href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">...</a>
                <a href="#">7</a>
                <a href="#">下一页</a>
                <a href="#">尾页</a>
            <!--</div>-->
            </div>
     </div>
     </article>
    </div>
  
     
</div>
<!--页面的底部-->
<div id="bottom_warp">
	<div class="bottom">
        <ul class="help">
        	<li class="head">帮助中心</li>
            <li><a href="#" target="_blank">账户管理</a></li>
            <li><a href="#" target="_blank">课程指南</a></li>
            <li><a href="#" target="_blank">班级选择</a></li>
        </ul>
        <ul class="sercive">
        	<li class="head">服务支持</li>
            <li><a href="#" target="_blank">售后政策</a></li>
            <li><a href="#" target="_blank">自助服务</a></li>
            <li><a href="#" target="_blank">相关下载</a></li>
        </ul>
        <ul class="follow_us">
        	<li class="head">关注我们</li>
            <li><a href="#" target="_blank">新浪微博</a></li>
            <li><a href="#" target="_blank">链接部落</a></li>
            <li><a href="#" target="_blank">官方微信</a></li>
        </ul>
        <ul class="cust_service">
            <li class="phone">400-128-2584</li>
            <li class="online_ser"><a href="#" target="_blank">在线客服</a></li>
        </ul>
    </div>
    <div class="copyRight">
        <p class="clear">Copyright&copy;2016广东石油化工学院云计算实验室版权所有</p>
    </div>
</div>
<div id="mask"></div>
</body>
</html>