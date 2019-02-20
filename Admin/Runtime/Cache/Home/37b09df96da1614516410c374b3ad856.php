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

						﻿				
				

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/admin.php/Home/Project/index">首页</a>
							</li>

							<li>
								<a href="/admin.php/Home/Project/index"> 项目管理</a>
							</li>
					
							<li class="active">编辑</li>
						</ul><!-- .breadcrumb -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
	　　　　　　</div><!-- /.page-header -->

		            
					<div class="col-xs-12" style="margin-top:50px;">
					<!-- PAGE CONTENT BEGINS -->
		
					<?php if(is_array($project)): foreach($project as $key=>$vo): endforeach; endif; ?>
					<form action="update" method="post" class="form-horizontal" role="form" >
					
					<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">ID：</label>

							<div class="col-sm-9">
								<input readonly="" type="text" class="col-xs-10 col-sm-5" name="id" id="form-input-readonly" value="<?php echo ($vo["id"]); ?>" />
								<span class="help-inline col-xs-12 col-sm-7">
									<label class="middle">
										<input class="ace" type="checkbox" id="id-disable-check" />
									</label>
								</span>
							</div>
						</div>
					
					<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">项目名称：</label>

							<div class="col-sm-9">
								<input type="text" class="col-xs-10 col-sm-5" name="name" id="myname" value="<?php echo ($vo["name"]); ?>"/>
								
								
									
							</div>
						</div>

				    <div class="space-4"></div>

					<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-2">时间要求：</label>

					<div class="col-sm-9">
					<input type="text" name="requireTime" id="form-field-2" class="col-xs-10 col-sm-5" value="<?php echo ($vo["requiretime"]); ?>" />
					</div>
						</div>

						<div class="space-4"></div>
						<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-2">项目要求：</label>

						<div class="col-sm-9">
						<input type="text" name="request" id="form-field-2" class="col-xs-10 col-sm-5" value="<?php echo ($vo["request"]); ?>" />
						</div>
					   </div>
	

						<div class="space-4"></div>

						<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-2">项目资料：</label>

						<div class="col-sm-9">
						<input type="text" name="dataUrl" id="form-field-2" class="col-xs-10 col-sm-5" value="<?php echo ($vo["dataurl"]); ?>" />
						</div>
					   </div>
					  
					   <div class="space-4"></div>

						<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-2">项目意义：</label>

						<div class="col-sm-9">
						
						<textarea rows="10" cols="53" name="sense" value="<?php echo ($vo["sense"]); ?>" ><?php echo ($vo["sense"]); ?></textarea>
						</div>
					   </div>
					   
					   <div class="space-4"></div>
					   
					   
					   <div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-2">选择分类：</label>
						
						<?php if(is_array($cate_list)): foreach($cate_list as $key=>$vo): ?>　　<input type="radio" name="cateId" value="<?php echo ($vo["id"]); ?>"/>
						　<?php echo ($vo["cname"]); endforeach; endif; ?>
						<?php if(is_array($project_cate_list)): foreach($project_cate_list as $key=>$vo): ?>　　<input type="hidden" name="name2" value="<?php echo ($vo["id"]); ?>"/><?php endforeach; endif; ?>
						<script>
						 window.onload = function (){var cateId  = document.getElementsByName("cateId");
													 var cateId2 = document.getElementsByName("name2");
													 //alert(cateId2.length);
														for (var i=0;i<cateId.length;i++){
														  for (var j=0;j<cateId2.length;j++){
															if(cateId[i].value == cateId2[j].value){
														  cateId[i].checked = true;}
														  }
														  }
														}
						</script>
					   </div>
					  
				       
						<div class="clearfix form-actions">
							<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info" type="button">
									<i class="icon-ok bigger-110"></i>
									<input type="submit" value="提交">
								</button>
							
								

								&nbsp; &nbsp; &nbsp;
								<button class="btn" type="reset">
									<i class="icon-undo bigger-110"></i>
									Reset
								</button>
							</div>
						</div>
					</form>
			</div>

				

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