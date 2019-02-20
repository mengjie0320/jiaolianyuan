<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>教练缘-支付中心</title>
		<link rel="stylesheet" href="/jiaolianyuan/Public/CSS/pay.css" />
		<link href="/jiaolianyuan/Public/images/second_sort/logo.ico" rel="icon"/>
		<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js" ></script>
		<script type="text/javascript" src="/jiaolianyuan/Public/js/pay.js" ></script>
	</head>
	<body>
		<div class="container">
			<div id="top">
				<div id="nav">
			        <a href="/jiaolianyuan/Home/Index/index.html"><img src="/jiaolianyuan/Public/images/second_sort/logo.png" alt="教练缘" title="教练缘"/></a>
			        <ul id="nav_left">
			            <li><a href="/jiaolianyuan/Home/Index/index.html" target="_parent">首页</a></li>
			            <li><a href="#" target="_parent">论坛</a></li>
			            <li><a href="#" target="_parent">帮助</a></li>
			              <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/Home/Coach/coach.html">个人中心</a></li><?php endif; ?>
					      <!--<?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/Home/Student/student">个人中心</a></li><?php endif; ?>
						  <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/Home/Login/login" onclick="warn()">个人中心</a></li><?php endif; ?>-->
			        </ul>
			        <ul id="nav_right">
						 <?php if(($name != '') OR ($phone != '')): ?><b><a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" ></a></b>
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
						 <?php else: ?>
						   <li class="right_login"><a href="/jiaolianyuan/Home/Login/login.html" target="_parent">登录</a></li>
				           <li class="right_register"><a href="/jiaolianyuan/Home/Register/register.html" target="_parent">注册</a></li><?php endif; ?>
			        </ul>
			    </div>
			</div>
			<div class="pay_content">
				<div class="pay_center">
					<div class="center_name">
						<p>支付中心</p>
					</div>
					<div class="center_img">
						<img src="/jiaolianyuan/Public/images/<?php echo ($classInfo[0]['classpic']); ?>" width="262" height="171" alt="centerImg"/>
						<div class="word_description">
							<p><strong><?php echo ($classInfo[0]['classname']); ?></strong></p>
						</div>
						<div class="class_price">
							<span>班级价格:</span>￥<?php echo ($classInfo[0]['classprice']); ?>
							<span>教练名字:<b><?php echo ($coachName); ?></b></span>
							<span>教练价格:</span>￥<?php echo ($coachprice); ?>
							<!--总       额:￥<?php echo ($sum); ?>-->
							<span>总       额:<strong>￥<?php echo ($sum); ?></strong></span>
						</div>
					</div>
					<div class="pay_way">
						<div class="way_name">
							<p>支付方式</p>
						</div>
						<div class="way_img">
							<img src="/jiaolianyuan/Public/images/pay/icon_wechat.png" alt="wayImg"/>
							<span>微信支付（默认）</span>
						</div>
					</div>
					<div class="pay_count">
						<div class="return_scan">
							<p><a href="/jiaolianyuan/Home/Detail/detail/id/<?php echo ($classInfo[0]['id']); ?>.html">返回继续浏览</a></p>
						</div>
						<div class="pay_price">
							<p><span>应付金额：</span><strong style="color: red;">￥<em><?php echo ($sum); ?></em></strong></p>
						</div>
						<div class="count_btn">
							<a href="#" id="pay"><input type="submit" value="去结算"/ onclick=" setTimeout('show()',500);"></a>
							<div class="circle"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="set_modal">
				<div class="modal_form" id="modal_form">
   			    	 <div class="modal_word">
   			    	 	<p>支付<span style="color: red;"><?php echo ($sum); ?></span>元</p>
   			    	 	
   			    	 </div>
   			    	 <div class="qrcode">
   			    	 	<p>微信扫一扫</p>
   			    	 	<img src="/jiaolianyuan/Home/Detail/qrcode" alt="二维码"/>
   			    	 	     <!--模拟付款按钮-->
							 <a  href="/jiaolianyuan/Home/Detail/payDeal/classId/<?php echo ($classInfo[0]['id']); ?>/coachId/<?php echo ($coachId['id']); ?>.html"><input class="button" type="button" value="模拟付款"/></a>
   			    	 </div>
   			    	 <div class="close_btn">
   			    	 	<a href="javascript:hide()"><img src="/jiaolianyuan/Public/images/pay/close.png"/></a>
   			    	 </div>
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
			        	<p>Copyright&copy;2016广东石油化工学院云计算实验室版权所有</p>
			    </div>
			  
			</div>
		</div>
		<div id="mask"></div>
		<script>
				var modal_form = document.getElementById('modal_form');
				var mask = document.getElementById('mask');
			     function show()
			     {
			         modal_form.style.display = "block";
			         mask.style.display = "block";
//			         var top = ($(window).height() - $('#modal_form').height())/2;   
			        var left = ($(window).width() - $('#modal_form').width())/2;   
			        var scrollTop = $(document).scrollTop();    
			        var scrollLeft = $(document).scrollLeft();   
			        var sTop = document.documentElement.scrollTop || document.body.scrollTop;
					var cHeight= document.documentElement.clientHeight || document.body.clientHeight;
					var mid = (cHeight - modal_form.offsetHeight) / 2; 
					if(navigator.appVersion.indexOf("MSIE 6")> -1){			//解决了在IE6的兼容性
						$('#modal_form').css( { position : 'absolute', 'top' :parseInt(sTop + mid) , left : left + scrollLeft } );
					}else{
						 $('#modal_form').css( { position : 'absolute', 'top' : mid , left : left + scrollLeft } );
					}
//			$('#modal_form').css( { position : 'absolute', 'top': top+scrollTop, left : left + scrollLeft } );       
			    
			     }
			     
			     function hide()
			     {
			         modal_form.style.display = "none";
			        mask.style.display = "none";
			     }
				$(function(){
				$("#pay").click(function(){
					$("#mask").css({
						display:"block",height:$(document).height()
					});
				})
			})
		</script>
		<script>
				$(function(){
			 	$(".close_btn").hover(function(){
			 		$(this).find('img').attr('src','/jiaolianyuan/Public/images/pay/close (2).png')
			 	},function(){
			 		$(this).find('img').attr('src','/jiaolianyuan/Public/images/pay/close.png')
			 	});
			 });
</script>
	</body>
</html>