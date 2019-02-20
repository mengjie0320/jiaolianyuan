<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="keywords" content="教练缘，教练，课程，IT自学">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘</title>
	<link href="/jiaolianyuan/Public/images/public/logo.ico"rel="icon" />
	<link rel="stylesheet" type="text/css" href="/jiaolianyuan/Public/CSS/common.css"/>
	<link rel="stylesheet" type="text/css" href="/jiaolianyuan/Public/CSS/style.css"/>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.1.4.min.js" ></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/index.js"></script>
<!--获取课程下的二级分类-->
<script>
var firstCateId=0;
		$(function(){
			$(".class-list li span").mouseover(function(){
		//获取一级分类id
		firstCateId = $(this).attr("id");
	$.ajax({
			contentType:"application/json",
			type:"get",
			url:"getSecondCate",
			data:{"id":firstCateId},
			dataType:"json",
			cache:"false",
			async:true,
			success: function(datac){
             $('.children-list li').detach();
             if(datac.ret == 200)
              {
				for (var i=0;i<datac.data.length;i++) {
					$('.children-list ').append('<li><a href="/jiaolianyuan/index.php/Home/Index/classList/id/'+ datac.data[i].id+'">'+datac.data[i].cname+'</a></li>');
				     }
			   }
			   //该课程尚无二级
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
//搜索框功能
	$(function(){
		$("#searchContent").change('input',function(){
		var	searchContent = $("#searchContent").val();

$.ajax({
		contentType:"application/json",
		type : "get",
		url : "search",
		
		data : {"searchContent":searchContent},
		dataType : "json",
		cache : "false",
		async : true,
		success : function(datac){
         if(datac.ret == 200)
          {
            $('.search-content span').detach();
			for (var i=0;i<datac.data.length;i++) 
			{
                $('.search-content').append('<a href="/jiaolianyuan/index.php/Home/Detail/detail/id/'+datac.data[i].id+'"><span >'+datac.data[i].classname+'</span></a><br />')
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

	function warn()
	{
		alert("请先登录");
	}
</script>			
</head>
<body> 		
<div class="top-warp">
	<div class="top">
		<a class="logo" href="#">教练缘，企业人才定制与自学平台</a>
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
			
		
<div class="nav-search">
	<ul class="index-nav">
	    <li>首页</li>
	    <li><a href="#">帮助中心</a></li>
	    <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/index.php/Home/Coach/coach.html">个人中心</a></li><?php endif; ?>
	    <?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/index.php/Home/Student/student.html">自学中心</a></li><?php endif; ?>
	    <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/index.php/Home/Login/login.html" onclick="warn()">自学中心</a></li><?php endif; ?>  
	</ul>
	<div class="search">
		<form>
			<input type="search" id="searchContent"  value="" placeholder="请输入关键字…"/>
			<input type="button" value="" />
		</form>
		<div class ="search-content"></div>
	</div>
</div>
<div class="carousel-warp">
	<div class="carousel">
		<ul class="class-list">
			<!--循环遍历课程名-->
			<?php if(is_array($getCourseCate)): $i = 0; $__LIST__ = $getCourseCate;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li id="<?php echo ($list['cname']); ?>">
					<a href="/jiaolianyuan/index.php/Home/Index/classList/id/<?php echo ($list['id']); ?>.html">
						<span id="<?php echo ($list['id']); ?>"><?php echo ($list['cname']); ?></span>
					</a>
					<!--显示背景-->
					<ul class="children-list" style="background:url(/jiaolianyuan/Public/images/guide-background/<?php echo ($list['cname']); ?>.jpg) no-repeat;"></ul>
				</li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
		</ul>
	<!--轮播图-->
		 <div id="banner_wrap">
			 <div id="banner_pic_wrap">
				 <ul id="banner_pic">
				 	<li><img src="/jiaolianyuan/Public/images/index/carousel/1.jpg"></li>
					<li><img src="/jiaolianyuan/Public/images/index/carousel/2.jpg"></li>
					<li><img src="/jiaolianyuan/Public/images/index/carousel/3.jpg"></li>
				 </ul>
			 </div>
			 <div id="banner_change_wrap">
				<div id="prev"></div>
				<div id="next"></div>
			 </div>
		 </div>
	</div>
</div>
		
<!--学员和教练流程图-->
<div class="flow-chart">
	<ul>
		<li>
			<img src="/jiaolianyuan/Public/images/index/student-pro.jpg" />
		</li>
		<li>
			<img src="/jiaolianyuan/Public/images/index/coach-pro.jpg" />
		</li>
	</ul>
</div>
	
<!--热门班级-->	
<div class="hot-classes">
	<strong>热门班级</strong>
	<ul>
		<?php if(is_array($hotClassList)): $i = 0; $__LIST__ = array_slice($hotClassList,0,5,true);if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$hotClassList): $mod = ($i % 2 );++$i;?><!--循环遍历热门课程图片-->
			<li>
				<a href="/jiaolianyuan/index.php/Home/Detail/detail/id/<?php echo ($hotClassList[0]['id']); ?>.html">
					<img src="/jiaolianyuan/Public/images/<?php echo ($hotClassList[0]['classpic']); ?>" />
					<div class="tip-info">
						<p class="class-name"><?php echo ($hotClassList[0]['classname']); ?></p>
						<p class="class-info"><?php echo ($hotClassList[0]['classintro']); ?></p>
					</div>
					<div class="learn-num"><span ><?php echo count($hotClassList) ?></span>人在学</div>
				</a>
			</li><?php endforeach; endif; else: echo "暂无数据" ;endif; ?>	
	</ul>	
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