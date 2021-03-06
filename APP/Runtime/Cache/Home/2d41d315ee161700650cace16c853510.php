<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="教练缘，教练，课程">
<meta name="description" content="教练缘为你量身订制教练学IT!">
<title>教练缘-学员自学中心</title>
<link href="/jiaolianyuan/Public/CSS/myclass.css" rel="stylesheet"/>
<link href="/jiaolianyuan/Public/images/student-center-img/logo.ico" rel="icon"/>
<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
</head>
<body>	
<!--导航栏-->
<div id="top">
	<div id="nav">
        <a href="/jiaolianyuan/Home/Index/index.html">
        	<h1>教练缘</h1>
        	<img src="/jiaolianyuan/Public/images/student-center-img/logo.png" alt="教练缘" title="教练缘"/>
        </a>
        <ul id="nav_left">
            <li><a href="/jiaolianyuan/Home/Index/index.html" target="_parent">首页</a></li>
            <li><a href="#" target="_parent">帮助中心</a></li>
              <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/Home/Coach/coach.html">自学中心</a></li><?php endif; ?>
			  <?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/Home/Student/student.html">自学中心</a></li><?php endif; ?>
			  <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/Home/Login/login.html" onclick="warn()">自学中心</a></li><?php endif; ?>       
        </ul>
        <ul id="nav_right">
            <?php if(($name != '') OR ($phone != '')): ?><b><a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>"></a></b> 	 
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
<!--自学流程图-->
<div class="lear-warp">
	<div class="lear">
		
	</div>
</div>
<!--主要内容-->
<div id="main">
    <div class="class">
      	<ul class="breadcrumb">
      		<li><a  href="#">自学中心</a><em></em></li>
			<li><a  href="#">班级</a></li>
      	</ul>
        <ul class="class_list">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂无班级" ;else: foreach($__LIST__ as $key=>$getClassList): $mod = ($i % 2 );++$i;?><li>
	                <a href="/jiaolianyuan/Home/Student/student2/classId/<?php echo ($getClassList['id']); ?>.html">
	                    <img src="/jiaolianyuan/Public/images/<?php echo ($getClassList['classpic']); ?>" alt="班级图片"/>
	                    <h2><?php echo ($getClassList['classname']); ?></h2>
	                    <?php if(($getClassList['graduatestatus'] == '0')): ?><span>未毕业</span> <a class="yiye" onclick="confirm('确定肄业？')?location.href='/jiaolianyuan/Home/Student/pauseStudy/classId/<?php echo ($getClassList['id']); ?>.html':''" href="javascript:;">选择肄业</a><?php endif; ?>
	                    <?php if(($getClassList['graduatestatus'] == '1')): ?><span>已毕业</span><?php endif; ?>    
	                    <?php if(($getClassList['graduatestatus'] == '2')): ?><span>已肄业</span><?php endif; ?>
	                </a>
	            </li><?php endforeach; endif; else: echo "暂无班级" ;endif; ?>
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
</body>
</html>