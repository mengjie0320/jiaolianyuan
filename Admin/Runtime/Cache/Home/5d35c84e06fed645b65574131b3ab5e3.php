<?php if (!defined('THINK_PATH')) exit();?>﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>教练缘后台管理系统</title>
		<meta name="keywords" content="Bootstrap模版,Bootstrap模版下载,Bootstrap教程,Bootstrap中文" />
		<meta name="description" content="站长素材提供Bootstrap模版,Bootstrap教程,Bootstrap中文翻译等相关Bootstrap插件下载" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
	
		<link rel="stylesheet" type="text/css" href="/Public/CSS/bootstrap.min.css" />
		<!--<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />-->
		<link rel="stylesheet" type="text/css" href="/Public/CSS/font-awesome.min.css" />
		<script type='text/javascript' src='/Public/js/jquery-1.10.2.min.js'></script>
		<link href="/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.min.js"></script>
        <script type="text/javascript" src="/Public/umeditor/lang/zh-cn/zh-cn.js"></script>
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->


		<!-- ace styles -->
       <link rel="stylesheet" type="text/css" href="/Public/CSS/ace.min.css" />
       <link rel="stylesheet" type="text/css" href="/Public/CSS/ace-rtl.min.css" />
       <link rel="stylesheet" type="text/css" href="/Public/CSS/ace-skins.min.css" />
	   

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		
		<!--<script type='text/javascript' src='/Public/js/ace-extra.min.js' />-->
		
        <script type="text/javascript" src="/Public/js/ace-extra.min.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<!--<script src="assets/js/html5shiv.js"></script>-->
		<!--<script src="assets/js/respond.min.js"></script>-->
		<!--[endif]-->
		<!-- <script>
			window.onload = function(){
			 var oUl    =   document.getElementById('daohang');
			 var aLi    =   oUl.getElementsByTagName('li');
			 //var aUl    =   oUl.getElementsByClassName('submenu');
			 var aLi3   =   oUl.getElementsByClassName('q')
			 var aLi2   =   aLi3[1].getElementsByTagName('li')
				//alert(aLi2.length);
				for(var i=0;i<aLi.length;i++){
				  
				  aLi2[i].onclick = function(){
						for(var i=0;i<aLi.length;i++){
								
								aLi[i].className='';
							}
						this.className='active';		
					}		
				}
			 
			
		}

		</script> -->
	</head>

	<body>
		<div class="navbar navbar-default" id="navbar" style="height:10px;">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							ACE后台管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!--<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-ok"></i>
									还有4个任务完成
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">软件更新</span>
											<span class="pull-right">65%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:65%" class="progress-bar "></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">硬件更新</span>
											<span class="pull-right">35%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:35%" class="progress-bar progress-bar-danger"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">单元测试</span>
											<span class="pull-right">15%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:15%" class="progress-bar progress-bar-warning"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">错误修复</span>
											<span class="pull-right">90%</span>
										</div>

										<div class="progress progress-mini progress-striped active">
											<div style="width:90%" class="progress-bar progress-bar-success"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										查看任务详情
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-bell-alt icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-warning-sign"></i>
									8条通知
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
												新闻评论
											</span>
											<span class="pull-right badge badge-info">+12</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<i class="btn btn-xs btn-primary icon-user"></i>
										切换为编辑登录..
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
												新订单
											</span>
											<span class="pull-right badge badge-success">+8</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
												粉丝
											</span>
											<span class="pull-right badge badge-info">+11</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										查看所有通知
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li> -->

						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-envelope icon-animated-vertical"></i>
								<?php if($unreadMessage == ''): ?><span class="badge badge-success">0条未读</span>
								<?php else: ?>
								<span class="badge badge-success"><?php echo ($unreadMessage); ?>条未读</span><?php endif; ?>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu">
								<li class="dropdown-header">
									<i class="icon-envelope-alt"></i>
									<?php echo ($unreadMessage); ?>条未读消息
								</li>

								<li>
								
										<a href="/admin.php/Home/Message/index">
											<i class="icon-double-angle-right"></i>
											收信箱
										</a>
									
								</li>

								<li>
								<a href="/admin.php/Home/Message/outBox">
											<i class="icon-double-angle-right"></i>
											发信箱
								</a>	
								</li>

							</ul>
						</li>

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="/Public/avatars/user.jpg" alt="Jason's Photo" />
								
								<span class="user-info">
									<small>欢迎光临</small>
									<?php echo (session('adminName')); ?>
									 
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="icon-cog"></i>
										设置
									</a>
								</li>

								<li>
									<a href="#">
										<i class="icon-user"></i>
										个人资料
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="/admin.php/Home/Index/out">
										<i class="icon-off"></i>
										退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list" id="daohang">
						<li class="active">
							<a href="#">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> 控制台 </span>
							</a>
						</li>
                         <li class="q">
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 模块管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="#">
										<i class="icon-double-angle-right"></i>
										导航管理
									</a>
								</li>

								<li>
									<a href="#">
										<i class="icon-double-angle-right"></i>
										轮播图片管理
									</a>
								</li>
							</ul>
						</li>
						
						<li class="q">
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 班级管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="/admin.php/Home/Class/index.html">
										<i class="icon-double-angle-right"></i>
										班级列表
									</a>
								</li>

								
							 </ul>
                          </li>
						  
						  <li class="q">
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text">  项目管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								

								<li>
									<a href="/admin.php/Home/Project/index.html">
										<i class="icon-double-angle-right"></i>
										项目列表
									</a>
								</li>

	
							 </ul>
                          </li>
						  
						  <li class="q">
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 分类管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="/admin.php/Home/Cate/index.html">
										<i class="icon-double-angle-right"></i>
										分类列表
									</a>
								</li>

								<li>
									<a href="/admin.php/Home/Cate/listC.html">
										<i class="icon-double-angle-right"></i>
										分类管理
									</a>
								</li>
							 </ul>
                          </li>
						  
						  <li class="q">
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 用户管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
														<ul class="submenu">
								<li>
									<a href="#" class="dropdown-toggle">
										<i class="icon-edit"></i>
										<span class="menu-text"> 教练管理 </span>

										<b class="arrow icon-angle-down"></b>
									</a>
									<ul class="submenu">
										<li>
											<a href="/admin.php/Home/Teacher/index">
												<i class="icon-double-angle-right"></i>已注册教练信息列表
											</a>
										</li>
										<li>
											<a href="/admin.php/Home/Teacher/checkAuditStatus">
												<i class="icon-double-angle-right"></i>等待认证教练列表
											</a>
										</li>
										<li>
											<a href="/admin.php/Home/Teacher/AuditStatusFinish">
												<i class="icon-double-angle-right"></i>已完成认证教练列表
											</a>
										</li>
									</ul>
								</li>
								
								

								<li>
									<a href="/admin.php/Home/Student/index">
										<i class="icon-double-angle-right"></i>
										学员管理
									</a>
								</li>
								
								<li>
									<a href="">
										<i class="icon-double-angle-right"></i>
										管理员管理
									</a>
								</li>
							</ul>
						
						</li>
						
						<li class="q">
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 批阅中心 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="/admin.php/Home/Work/listW">
										<i class="icon-double-angle-right"></i>
										已批阅项目列表
									</a>
								</li>

								<li>
									<a href="/admin.php/Home/Work/index">
										<i class="icon-double-angle-right"></i>
										未批阅项目列表
									</a>
								</li>
							   </ul>
                          </li>
						
							<li class="q">
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 消息中心 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="/admin.php/Home/Message/index">
										<i class="icon-double-angle-right"></i>
										收信箱
									</a>
								</li>

								<li>
									<a href="/admin.php/Home/Message/outBox">
										<i class="icon-double-angle-right"></i>
										发信箱
									</a>
								</li>
							   </ul>
                          </li>
						
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>

				<div class="main-content" >
					<div class="breadcrumbs" id="breadcrumbs">

									
					<script>
					var newImg = document.createElement("img");
					  newImg.src = "<?php echo (html_entity_decode($list_1[0]['classpic'])); ?>";
					  newImg.style.width = "300px";
					  $("#pic").append(newImg);
					</script>
					<ul class="breadcrumb" style="line-height:50px;">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/admin.php/Home/Class/index">首页</a>
							</li>

							<li>
								<a href="/admin.php/Home/Class/index">班级管理</a>
							</li>
							
							<li class="active">班级详情</li>
							
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
					</div>


				
			
				<div  style="margin-left:5px;font-size:20px;">
					<!--<h3 class="main-heading"><span>Contact info</span></h3>-->

					<ul style=" list-style-type:none;">
						<?php if(is_array($list_1)): foreach($list_1 as $key=>$vo): ?><li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-barcode">						</i> 班 　 　 号:</span>　 <?php echo ($list_1[0]['classno']); ?></li>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-tag">					</i> 班 级 名 称:</span>　 <?php echo ($vo["classname"]); ?></li>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-usd">						</i> 班 级 价 格:</span>　 <?php echo ($vo["classprice"]); ?>元</li>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-dashboard">					</i> 开 班 时 间:</span>　 <?php echo ($vo["starttime"]); ?></li>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-time">						</i> 平 均 周 期:</span>　 <?php echo ($vo["aveperiod"]); ?></li>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-list">						</i> 所 属 分 类:</span>　 <?php echo ($vo["cname"]); ?></li>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-usd">						</i> 最低咨询费:</span>　 <?php echo ($vo["coachminprice"]); ?>元</li>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-usd">						</i> 最高咨询费:</span>　 <?php echo ($vo["coachmaxprice"]); ?>元</li>
						<li id="pic" style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-picture">						</i>  缩　略　图:</span>　 <img style="width:150px;" src="http://localhost/Public/images/<?php echo ($vo["classpic"]); ?>" /></li>
						<li style="padding:10px 10px 50px 10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-list-alt">		</i> 班 级 简 介:</span>　 <?php echo ($vo["classintro"]); ?></li><?php endforeach; endif; ?>
						</ul>
						
						
						
					<div>	
						<table id="sample-table-1" class="table table-striped table-bordered table-hover" style="width:80%;margin-top:100px;">
								<thead>
									<tr>
										<th class="center" style="color:red;">班级内容</th>
										<th class="center">项目序号:</th>	
										<th class="center">项目名称:</th>
									</tr>
								</thead>
								   
								<tbody>
								 <?php if(is_array($list_3)): foreach($list_3 as $key=>$vo): ?><tr class="center">
										<td style="border:0px;"><?php echo ($vo[""]); ?></td>
										<td><?php echo ($vo[""]); ?></td>
										<td><?php echo ($vo["name"]); ?></td>											
									</tr><?php endforeach; endif; ?>
								</tbody>
							</table>
					</div>
					<div>
						<table id="sample-table-1" class="table table-striped table-bordered table-hover" style="width:80%;margin-top:100px;">
								<thead>
									<tr>
										<th class="center" style="color:red;">班级教练</th>
										<th class="center">教练号:</th>	
										<th class="center">教练名:</th>
									</tr>
								</thead>
								   
								<tbody>
								 <?php if(is_array($list_2)): foreach($list_2 as $key=>$vo): ?><tr class="center">
										<td style="border:0px;"><?php echo ($vo[""]); ?></td>
										<td><?php echo ($vo[""]); ?></td>
										<td><?php echo ($vo["tname"]); ?></td>											
									</tr><?php endforeach; endif; ?>
								</tbody>
							</table>
					</div>	
					<div>	
					<table id="sample-table-1" class="table table-striped table-bordered table-hover" style="width:80%;margin-top:100px;">
								<thead>
									<tr>
										<th class="center" style="color:red;">班级学员</th>
										<th class="center">学生号:</th>	
										<th class="center">学生名:</th>
									</tr>
								</thead>
								   
								<tbody>
								 <?php if(is_array($list_4)): foreach($list_4 as $key=>$vo): ?><tr class="center">
										<td style="border:0px;"><?php echo ($vo[""]); ?></td>
										<td><?php echo ($vo[""]); ?></td>
										<td><?php echo ($vo["stuname"]); ?></td>											
									</tr><?php endforeach; endif; ?>
								</tbody>
							</table>

						</div>
						
						
						
				</div>
				<!-- /Contact Info -->
				<div class="clear"></div>

	  

	


				

						<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse" style="position: fixed;right: 20px;bottom: 10px;">
							<i class="icon-double-angle-up icon-only bigger-110"></i>
						</a>
					</div><!-- /.main-container -->
				</div>
		<!-- basic scripts -->


		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='/Public/js/jquery-2.0.3.min.js'>"+"<"+"script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='/Public/js/jquery-1.10.2.min.js'>"+"<"+"script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='/Public/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
		</script>
		<script type='text/javascript' src='/Public/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='/Public/js/typeahead-bs2.min.js'></script>
	
				

				<script type='text/javascript' src='/Public/js/jquery-ui-1.10.3.custom.min.js'></script>

	
				<script type='text/javascript' src='/Public/js/jquery.ui.touch-punch.min.js'></script>

		
				<script type='text/javascript' src='/Public/js/jquery.slimscroll.min.js'></script>

		
				<script type='text/javascript' src='/Public/js/jquery.easy-pie-chart.min.js'></script>

		
				<script type='text/javascript' src='/Public/js/jquery.sparkline.min.js'></script>


				<script type='text/javascript' src='/Public/js/flot/jquery.flot.min.js'></script>

	
				<script type='text/javascript' src='/Public/js/flot/jquery.flot.pie.min.js'></script>

				<script type='text/javascript' src='/Public/js/flot/jquery.flot.resize.min.js'></script>


		<!-- ace scripts -->

		<script src="/Public/js/ace-elements.min.js"></script>
		<script src="/Public/js/ace.min.js"></script>

</body>
</html>