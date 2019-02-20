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
	
		<link rel="stylesheet" type="text/css" href="/jiaolianyuan/Public/CSS/bootstrap.min.css" />
		<!--<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />-->
		<link rel="stylesheet" type="text/css" href="/jiaolianyuan/Public/CSS/font-awesome.min.css" />
		<script type='text/javascript' src='/jiaolianyuan/Public/js/jquery-1.10.2.min.js'></script>
		<link href="/jiaolianyuan/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/jiaolianyuan/Public/umeditor/third-party/jquery.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/jiaolianyuan/Public/umeditor/umeditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/jiaolianyuan/Public/umeditor/umeditor.min.js"></script>
        <script type="text/javascript" src="/jiaolianyuan/Public/umeditor/lang/zh-cn/zh-cn.js"></script>
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->


		<!-- ace styles -->
       <link rel="stylesheet" type="text/css" href="/jiaolianyuan/Public/CSS/ace.min.css" />
       <link rel="stylesheet" type="text/css" href="/jiaolianyuan/Public/CSS/ace-rtl.min.css" />
       <link rel="stylesheet" type="text/css" href="/jiaolianyuan/Public/CSS/ace-skins.min.css" />
	   

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		
		<!--<script type='text/javascript' src='/jiaolianyuan/Public/js/ace-extra.min.js' />-->
		
        <script type="text/javascript" src="/jiaolianyuan/Public/js/ace-extra.min.js"></script>
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
								
										<a href="/jiaolianyuan/admin.php/Home/Message/index">
											<i class="icon-double-angle-right"></i>
											收信箱
										</a>
									
								</li>

								<li>
								<a href="/jiaolianyuan/admin.php/Home/Message/outBox">
											<i class="icon-double-angle-right"></i>
											发信箱
								</a>	
								</li>

							</ul>
						</li>

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="/jiaolianyuan/Public/avatars/user.jpg" alt="Jason's Photo" />
								
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
									<a href="/jiaolianyuan/admin.php/Home/Index/out">
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
									<a href="/jiaolianyuan/admin.php/Home/Class/index.html">
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
									<a href="/jiaolianyuan/admin.php/Home/Project/index.html">
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
									<a href="/jiaolianyuan/admin.php/Home/Cate/index.html">
										<i class="icon-double-angle-right"></i>
										分类列表
									</a>
								</li>

								<li>
									<a href="/jiaolianyuan/admin.php/Home/Cate/listC.html">
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
											<a href="/jiaolianyuan/admin.php/Home/Teacher/index">
												<i class="icon-double-angle-right"></i>已注册教练信息列表
											</a>
										</li>
										<li>
											<a href="/jiaolianyuan/admin.php/Home/Teacher/checkAuditStatus">
												<i class="icon-double-angle-right"></i>等待认证教练列表
											</a>
										</li>
										<li>
											<a href="/jiaolianyuan/admin.php/Home/Teacher/AuditStatusFinish">
												<i class="icon-double-angle-right"></i>已完成认证教练列表
											</a>
										</li>
									</ul>
								</li>
								
								

								<li>
									<a href="/jiaolianyuan/admin.php/Home/Student/index">
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
									<a href="/jiaolianyuan/admin.php/Home/Work/listW">
										<i class="icon-double-angle-right"></i>
										已批阅项目列表
									</a>
								</li>

								<li>
									<a href="/jiaolianyuan/admin.php/Home/Work/index">
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
									<a href="/jiaolianyuan/admin.php/Home/Message/index">
										<i class="icon-double-angle-right"></i>
										收信箱
									</a>
								</li>

								<li>
									<a href="/jiaolianyuan/admin.php/Home/Message/outBox">
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

									
					
					<ul class="breadcrumb" style="line-height:50px;">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="/jiaolianyuan/admin.php/Home/Message/index">首页</a>
							</li>

							<li>
								<a href="/jiaolianyuan/admin.php/Home/Message/index">消息中心</a>
							</li>
							<li class="active">收件箱</li>
							
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


				<div class="page-header">
							
						</div><!-- /.page-header -->
			
				<div  style="margin-left:30px;font-size:20px;">
					<!--<h3 class="main-heading"><span>Contact info</span></h3>-->

					<ul style=" list-style-type:none;">
						<?php if(is_array($list_1)): foreach($list_1 as $key=>$vo): if($vo['sendertype'] == '2'): ?><li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-user"></i> 发件人名称:</span> <?php echo ($vo["sendername"]); ?>(学员)</li>
						<?php elseif($vo['sendertype'] == '1'): ?>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-user"></i> 发件人名称:</span> <?php echo ($vo["sendername"]); ?>(教练)</li>
						<?php else: ?>
						<li style="padding:10px;border-bottom:1px solid #F2F2F2;"><span style="font-weight:700;"><i class="glyphicon glyphicon-user"></i> 发件人名称:</span> <?php echo ($vo["sendername"]); ?>(教练缘管理员)</li><?php endif; ?>
						<li style="padding:10px;border:1px solid #F2F2F2;"><span style="font-weight:700;" ><i class="glyphicon glyphicon-list-alt"></i> 消息内容:</span>　 <?php echo (html_entity_decode($vo["content"])); ?>
						<div style="margin-left:80%;font-size:16px;color:gray;"><?php echo ($vo["time"]); ?></div>
						</li><?php endforeach; endif; ?>
				        <li style="padding:10px;border:1px solid #F2F2F2;color:red"><i class="glyphicon glyphicon-envelope"></i> 回　　复：</li>
						<?php if(is_array($list_2)): foreach($list_2 as $key=>$vo): ?><li style="padding:10px;border:1px solid #F2F2F2;"><?php echo ($vo["sendername"]); ?>　回复　<?php echo ($vo["targetname"]); ?>:</span>　 <?php echo (html_entity_decode($vo["content"])); ?>
						<div style="margin-left:80%;font-size:16px;color:gray;"><?php echo ($vo["time"]); ?></div></li><?php endforeach; endif; ?>
					</ul>
				</div>
				<?php if(is_array($list_1)): foreach($list_1 as $key=>$vo): endforeach; endif; ?>
				<div style="margin-left:60px;">
					<form action="addReply" method="post" class="form-horizontal" role="form">
						<input type="hidden" name="senderName" value="admin">
						<input type="hidden" name="targetName" value="<?php echo ($vo["sendername"]); ?>">
						<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
						
						<div>
						<!--style给定宽度可以影响编辑器的最终宽度-->
						 <script type="text/plain" name="content" id="myEditor" style="width:90%;height:240px;">
						 </script>
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
							function isFocus(){
								alert(um.isFocus())
							}
							function doBlur(){
								um.blur()
							}
							function createEditor() {
								enableBtn();
								um = UM.getEditor('myEditor');
							}
							function getAllHtml() {
								alert(UM.getEditor('myEditor').getAllHtml())
							}
							function getContent() {
								var arr = [];
								arr.push("使用editor.getContent()方法可以获得编辑器的内容");
								arr.push("内容为：");
								arr.push(UM.getEditor('myEditor').getContent());
								alert(arr.join("\n"));
							}
							function getPlainTxt() {
								var arr = [];
								arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
								arr.push("内容为：");
								arr.push(UM.getEditor('myEditor').getPlainTxt());
								alert(arr.join('\n'))
							}
							function setContent(isAppendTo) {
								var arr = [];
								arr.push("使用editor.setContent('欢迎使用umeditor')方法可以设置编辑器的内容");
								UM.getEditor('myEditor').setContent('欢迎使用umeditor', isAppendTo);
								alert(arr.join("\n"));
							}
							function setDisabled() {
								UM.getEditor('myEditor').setDisabled('fullscreen');
								disableBtn("enable");
							}

							function setEnabled() {
								UM.getEditor('myEditor').setEnabled();
								enableBtn();
							}

							function getText() {
								//当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
								var range = UM.getEditor('myEditor').selection.getRange();
								range.select();
								var txt = UM.getEditor('myEditor').selection.getText();
								alert(txt)
							}

							function getContentTxt() {
									var arr = [];
								//arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
								//arr.push("编辑器的纯文本内容为：");
								arr.push(UM.getEditor('myEditor').getContentTxt());
								alert(arr);
							}
							function hasContent() {
								var arr = [];
								arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
								arr.push("判断结果为：");
								arr.push(UM.getEditor('myEditor').hasContents());
								alert(arr.join("\n"));
							}
							function setFocus() {
								UM.getEditor('myEditor').focus();
							}
							function deleteEditor() {
								disableBtn();
								UM.getEditor('myEditor').destroy();
							}
							function disableBtn(str) {
								var div = document.getElementById('btns');
								var btns = domUtils.getElementsByTagName(div, "button");
								for (var i = 0, btn; btn = btns[i++];) {
									if (btn.id == str) {
										domUtils.removeAttributes(btn, ["disabled"]);
									} else {
										btn.setAttribute("disabled", "true");
									}
								}
							}
							function enableBtn() {
								var div = document.getElementById('btns');
								var btns = domUtils.getElementsByTagName(div, "button");
								for (var i = 0, btn; btn = btns[i++];) {
									domUtils.removeAttributes(btn, ["disabled"]);
								}
							}
						</script>
			             </div>
						<div style="margin-left:85%;margin-top:20px;" >
							<button class="btn btn-info">回复</button>
						</div>
					</form>
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
			window.jQuery || document.write("<script src='/jiaolianyuan/Public/js/jquery-2.0.3.min.js'>"+"<"+"script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='/jiaolianyuan/Public/js/jquery-1.10.2.min.js'>"+"<"+"script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='/jiaolianyuan/Public/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
		</script>
		<script type='text/javascript' src='/jiaolianyuan/Public/js/bootstrap.min.js'></script>
		<script type='text/javascript' src='/jiaolianyuan/Public/js/typeahead-bs2.min.js'></script>
	
				

				<script type='text/javascript' src='/jiaolianyuan/Public/js/jquery-ui-1.10.3.custom.min.js'></script>

	
				<script type='text/javascript' src='/jiaolianyuan/Public/js/jquery.ui.touch-punch.min.js'></script>

		
				<script type='text/javascript' src='/jiaolianyuan/Public/js/jquery.slimscroll.min.js'></script>

		
				<script type='text/javascript' src='/jiaolianyuan/Public/js/jquery.easy-pie-chart.min.js'></script>

		
				<script type='text/javascript' src='/jiaolianyuan/Public/js/jquery.sparkline.min.js'></script>


				<script type='text/javascript' src='/jiaolianyuan/Public/js/flot/jquery.flot.min.js'></script>

	
				<script type='text/javascript' src='/jiaolianyuan/Public/js/flot/jquery.flot.pie.min.js'></script>

				<script type='text/javascript' src='/jiaolianyuan/Public/js/flot/jquery.flot.resize.min.js'></script>


		<!-- ace scripts -->

		<script src="/jiaolianyuan/Public/js/ace-elements.min.js"></script>
		<script src="/jiaolianyuan/Public/js/ace.min.js"></script>

</body>
</html>