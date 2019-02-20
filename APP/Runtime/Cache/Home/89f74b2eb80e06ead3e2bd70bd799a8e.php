<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>教练缘</title>
		<link href="/jiaolianyuan/Public/images/logo.ico"rel="icon" />
		<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.1.4.min.js" ></script>
		<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
		<script type="text/javascript" src="/jiaolianyuan/Public/js/coach.js"></script>
		<link rel="stylesheet" type="text/css" href="/jiaolianyuan/Public/CSS/style.css"/>
		

		<!--<script>

		//获取课程下的班级
		var cname=0;
				$(function(){
					$(".nav-left ul li span").mouseover(function(){
				//获取一级分类id
//					$(".nav-left ul li ").mouseover(function(){
				
//				cname = $(this).attr("id");
                cname = $(this).html();
			$.ajax({
					contentType:"application/json",
					type:"get",
					url:"http://localhost/jiaolianyuan/index.php/Home/Index/getClassList",
					data:{"cname":cname},
					dataType:"json",
					cache:"false",
					async:true,
					success: function(datac){
                        // datac.data[0].id 为班级id,以后可以加在链接上+++
                       //在下面执行append追加前先清除掉原先的，不然后重叠
                     $('.children-list li').detach();
                     if(datac.ret == 200)
                      {
						for (var i=0;i<datac.data.length;i++) {
                            //动态生成结点,并赋值id,二级分类名,二级分类对应的id,即cid
							$('.children-list ').append('<li><a href="/jiaolianyuan/Home/Detail/detail/id/'+ datac.data[i].id+'">'+datac.data[i].classname+'</a></li>');
						     }
					   }
					   //该课程尚无班级
					   else
					   {
							$('.children-list ').append('<li><a href="javascript:;">'+datac.data+'</a></li>');
					   }
   

					},
					error: function(datac){
						alert("出错啦")
					}
			});
			
					
			});
				})
					
</script>-->
		
<script>
				$(function(){
					$("#searchContent").change('input',function(){
					var	searchContent = $("#searchContent").val();
			
			$.ajax({
					contentType:"application/json",
					type : "get",
//					url : "http://localhost/jiaolianyuan/index.php/Home/Index/search",
					url : "http://localhost/jiaolianyuan/index.php/Home/Index/search",
					
					data : {"searchContent":searchContent},
					dataType : "json",
					cache : "false",
					async : true,
					success : function(datac){
                     if(datac.ret == 200)
                      {
                        $('.dada span').detach();
						for (var i=0;i<datac.data.length;i++) 
						{
                            $('.dada').append('<a href="/jiaolianyuan/Home/Detail/detail/id/'+datac.data[i].id+'"><span >'+datac.data[i].classname+'</span></a><br />')
					    }
				      }
                      //该课程尚无班级
                       else
					   {
					   	alert(datac.data);
                       }
					},
					error: function(datac){
						alert("出错啦")
					}
			    });
			  });
		   })
					
</script>
<script>
		
	function warn()
	{
		alert("请先登录");
	}
</script>		
		
		
	</head>
	<body>
		
		 <!--搜索框内容位置，自己瞎放的-->   
		
		         
		         
		<div class="contianer">
			<header>
				<div class="heading">
					<div class="heading-center">
						<div class="logo">
							<a href="/jiaolianyuan/Home/Index/index.html"><img src="/jiaolianyuan/Public/images/web首页素材/logo.png" alt="logo" /></a>	
						</div>
						<div class="login-reg" id="login-reg">
							 <?php if(($name != '') OR ($phone != '')): ?><a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" ></a>
							 	
							 	<!--教练头像进入个人中心-->
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
							  <!--<?php if(($name != '') OR ($phone != '') AND ($identity == 'teacher')): ?><a href="/jiaolianyuan/Home/Coach/coach"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" width="28" height="28"></a><p class="myp" style="width:120px;height: 60px;"><?php echo ($name); ?><span class="logout"><a href="/jiaolianyuan/Home/Login/logout">退出</a></span></p><?php endif; ?>-->
							  <!--<?php if(($name != '') OR ($phone != '') AND ($identity == 'student')): ?><a href="/jiaolianyuan/Home/Student/student"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" width="28" height="28"></a><p class="myp" style="width:120px;height: 60px;"><?php echo ($name); ?><span class="logout"><a href="/jiaolianyuan/Home/Login/logout">退出</a></span></p><?php endif; ?>-->
							 <?php else: ?>
							 <div class="login">
								    <a href="/jiaolianyuan/Home/Login/login">登录</a>
							 </div>
							 <div class="reg">
									<a href="/jiaolianyuan/Home/Register/register">注册</a>
							 </div><?php endif; ?>        
						</div>
					</div>
				</div>
			</header>
			
				<div class="content">
					<div class="all-classes">
						<img src="/jiaolianyuan/Public/images/web首页素材/全部课程.png" alt="all-classes" width="240" height="70"/>
					</div>					
						<div class="nav_search">
						<div class="nav">
							<ul id="header-nav">
							  <li><a href="javasrcipt:;">首页</a></li>
							  <li><a href="javasrcipt:;">帮助</a></li>
							  <li><a href="javasrcipt:;">论坛</a></li>
							  <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/Home/Coach/coach.html">个人中心</a></li><?php endif; ?>
							  <?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/Home/Student/student.html">个人中心</a></li><?php endif; ?>
							  <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/Home/Login/login.html" onclick="warn()">个人中心</a></li><?php endif; ?>
							  
							</ul>
						</div>
						<div class="search">
							<form>
								<label>
									<input type="button" value="" />
									<input type="text" id="searchContent"  value="" placeholder="请输入关键字…"/>
								</label>
							</form>
							 <div class = "dada">
		 						
		 					</div>
						</div>
					</div>
						<div class="nav-left">
							
							<ul>
								<!--循环遍历课程名-->
								<?php if(is_array($getCourseCate)): $i = 0; $__LIST__ = $getCourseCate;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li id="<?php echo ($list['cname']); ?>" class="first-list"><a href="/jiaolianyuan/Home/Index/classList/id/<?php echo ($list['id']); ?>.html"><span  class="classname"><?php echo ($list['cname']); ?></span></a>
									<hr />
									    <!--显示背景-->
										<!--<ul class="children-list" style="background:url(/jiaolianyuan/Public/images/guide-background/<?php echo ($list['cname']); ?>.jpg) no-repeat;">
										</ul>-->
								</li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
							</ul>
						</div>
						
						<div class="carousel">
							 <div id="big_banner_wrap">
							 <div id="big_banner_pic_wrap">
								 <ul id="big_banner_pic">
								 	 <li><img src="/jiaolianyuan/Public/images/web首页素材/1.jpg"></li>
									 <li><img src="/jiaolianyuan/Public/images/web首页素材/大轮播.jpg"></li>
									 <li><img src="/jiaolianyuan/Public/images/web首页素材/29.jpg"></li>
								 </ul>
							 </div>
							 <div id="big_banner_change_wrap">
								 <div id="big_banner_change_prev"> &lt;</div>
								 <div id="big_banner_change_next">&gt;</div>
							 </div>
							 </div>
						</div>
						<div class="hot-classes">
							<div class="strategy">
							<ul>
								<li class="add_border">
									<img src="/jiaolianyuan/Public/images/index/student.png" />
								</li>
								<li class="add_border processImg">
									<img src="/jiaolianyuan/Public/images/index/student_process.png" />
								</li>
							</ul>
						</div>
							<div class="strategy">
							<ul>
								<li class="add_border">
									<img src="/jiaolianyuan/Public/images/index/coach.png" />
								</li>
								<li class="add_border processImg">
									<img src="/jiaolianyuan/Public/images/index/coach_process.png" />
								</li>
							</ul>
							
						</div>
						<div class="hot-recomendation">
							<p>热门班级</p>
							<ul>
								<!--循环遍历热门课程图片-->
								<?php if(is_array($hotClassList)): $i = 0; $__LIST__ = array_slice($hotClassList,0,5,true);if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$hotClassList): $mod = ($i % 2 );++$i;?><li><a href="/jiaolianyuan/Home/Detail/detail/id/<?php echo ($hotClassList[0]['id']); ?>.html"><img src="/jiaolianyuan/Public/images/<?php echo ($hotClassList[0]['classpic']); ?>" />
								<div class="tip_info">
									<p class="big_word"><?php echo ($hotClassList[0]['classname']); ?></p>
									<p class="small_word"><?php echo ($hotClassList[0]['classintro']); ?></p>
								</div>
									
								<div class="box_bottom"><span ><?php echo count($hotClassList) ?></span>人在学</div>
								</a></li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
								
							</ul>
							
						</div>
						</div>
						
						<div class="classes-sort">
							<p>PHP工程师</p>
							<div class="ad-left">
								<img src="/jiaolianyuan/Public/images/web首页素材/php工程师/广告.png"/ width="224" height="436">
							</div>
							<div class="classes-right">
								<ul>
								<!-- 循环遍历8个PHP工程师课程 -->
								<?php if(is_array($phpData)): $i = 0; $__LIST__ = $phpData;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$phpData): $mod = ($i % 2 );++$i;?><li><a href="/jiaolianyuan/Home/Detail/detail/id/<?php echo ($phpData['id']); ?>.html"><img src="/jiaolianyuan/Public/images/<?php echo ($phpData['classpic']); ?>"/>
										<div class="pic_info">
										<p class="title"><?php echo ($phpData['classname']); ?></p>
										<p class="info_detail"><?php echo ($phpData['classintro']); ?></p>
										<p class="num"><span>12564</span>人在学</p>
									</div>
									</a></li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>  
								</ul>
							</div>
						</div>
				</div>
			<footer>
				<div class="footer">
					<div class="my-footer">
						<div class="footer-first">
						<div class="footer_1">
							<ul>
								<li><a href="#"><h4>帮助中心</h4></a>
									<ul>
										<li><a href="#">账户管理</a></li>
										<li><a href="#">购物指南</a></li>
										<li><a href="#">订单操作</a></li>
									</ul>
								</li>
								<li><a href="#"><h4>服务支持</h4></a>
									<ul>
										<li><a href="#">售后政策</a></li>
										<li><a href="#">自助服务</a></li>
										<li><a href="#">相关下载</a></li>
									</ul>
								</li>
								<li><a href="#"><h4>关注我们</h4></a>
									<ul>
										<li><a href="#">新浪微博</a></li>
										<li><a href="#">qq邮箱</a></li>
										<li><a href="#">官方微信</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
						<div id="contact">
						<p>400-100-12580</p>
						<p><button>在线客服</button></p>
						</div>
					</div>
				</div>
				<div class="footer-last">
							<ul>
								<li><a href="#">关于我们</a>|</li>
								<li><a href="#">联系我们</a>|</li>
								<li><a href="#">商家入驻</a>|</li>
								<li><a href="#">友情链接</a>|</li>
								<li><a href="#">意见反馈</a>|</li>
								<li><a href="#">售后服务</a>|</li>
								<li><a href="#">知识产权</a></li>
							</ul>
						</div>
							<br />
							<div class="power">
							<p>
								Copyright&copy;2016广东石油化工学院云计算实验室版权所有
							</p>
						</div>
			</footer>
		</div>
	</body>
	
	
	<!--<script>
	$(document).ready(function(){
		 $.ajax({
					contentType:"application/json",
					type : "get",
					url : "http://localhost/jiaolianyuan/index.php/Home/Index/getStuNum",
//					data : {"searchContent":searchContent},
					dataType : "json",
					cache : "false",
					async : true,
					success : function(datac){
//                     $('.box_bottom ').detach();
                     for (var i=0;i<datac.data.length;i++) {
//                  alert(datac.data.length);
//  	         document.getElementById(i).innerHTML = datac.data[i].num;  //因为发送时间比较长，所以先显示发送中
                     
                            
                            $('.box_bottom  ').append('<span>'+datac.data[i].num+'</span>人在学');
//                          alert ( datac.a[i].id);
//							$('.hot-recomendation ul').append('<li><a href="/jiaolianyuan/Home/Detail/detail/id/'+datac.a[i].id+'"><img src="/jiaolianyuan/Public/images/'+datac.a[i].classpic+'" /><div class="tip_info"><p class="big_word">'+datac.a[i].classname+'</p><p class="small_word">'+datac.a[i].classintro+'</p></div><div class="box_bottom"><span>'+datac.b[i].num+'</span>人在学</div></a></li>');
//						    $('.hot-recomendation ul').append('<li><a href="/jiaolianyuan/Home/Detail/detail/id/'+datac.a[i].id+'"><img src="/jiaolianyuan/Public/images/'+datac.a[i].classpic+'" /><div class="tip_info"><p class="big_word">'+datac.a[i].classname+'</p><p class="small_word">'+datac.a[i].classintro+'</p></div><div class="box_bottom"><span>'+datac.b[i].num+'</span>人在学</div></a></li>').hover;
//                   alert("d");
                     
                     }
					},
					error: function(datac){
						alert("出错啦")
					}
			  });
			  });
	</script>-->
</html>