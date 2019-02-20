<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="教练缘，教练，课程">
<meta name="description" content="教练缘为你量身订制教练学IT!">
<title>教练缘-学员中心</title>
<link href="/jiaolianyuan/Public/CSS/student-center.css" rel="stylesheet"/>
<link href="/jiaolianyuan/Public/images/student-center-img/logo.ico" rel="icon"/>
<link href="/jiaolianyuan/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="/jiaolianyuan/Public/js/stucenter.js"></script>
<script type="text/javascript" src="/jiaolianyuan/Public/js/threeconnect.js"></script>
<script src="/jiaolianyuan/Public/js/uploadPreview.js" type="text/javascript"></script>
<script type="text/javascript" src="/jiaolianyuan/Public/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/jiaolianyuan/Public/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/jiaolianyuan/Public/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/jiaolianyuan/Public/umeditor/lang/zh-cn/zh-cn.js"></script>

 <!--<script type="text/javascript">
  function confirmPauseStudy(){
    var mymessage= confirm("确定肄业?") ;       ;
    if(mymessage==true)
    {
    	$(this).attr('href','/jiaolianyuan/Home/Student/pauseStudy/classId/<?php echo ($getClassList['id']); ?>');
    }
    else
    {
        
    }
  }    
  </script>-->
  <script>
	$(function(){
 	$(".close_btn").hover(function(){
 		$(this).find('img').attr('src','/jiaolianyuan/Public/images/close (2).png')
 	},function(){
 		$(this).find('img').attr('src','/jiaolianyuan/Public/images/close.png')
 	});
 });
</script>

<!--给有未读信息的主题加个小红点-->
<script>
        $(function(){
          var searchContent = $("#searchContent").val();
      
      $.ajax({
          contentType:"application/json",
          type : "get",
          url : "http://localhost/jiaolianyuan09132/index.php/Home/Student/searchTitleId",
          dataType : "json",
          cache : "false",
          async : true,
          success : function(datac){
                     if(datac.ret == 200)
                      {
            for (var i=0;i<datac.data.length;i++) 
            {
                            $("#title"+datac.data[i]['referid']).append("<img src='/jiaolianyuan/Public/images/student-center-img/new_message.png'/>");
              }
              }
                      //该课程尚无班级
//                     else
//             {
//              alert(datac.data);
//                     }
          },
          error: function(datac){
            alert("出错啦")
          }
          });
       })
          
</script>
</head>

<body>


	
	
	
<!--导航栏-->
<!--<div class="container">-->
<div id="top">
	<div id="nav">
        <a href="/jiaolianyuan/Home/Index/index.html"><img src="/jiaolianyuan/Public/images/student-center-img/logo.png" alt="教练缘" title="教练缘"/></a>
        <ul id="nav_left">
            <li><a href="/jiaolianyuan/Home/Index/index.html" target="_parent">首页</a></li>
            <li><a href="#" target="_parent">论坛</a></li>
            <li><a href="#" target="_parent">帮助</a></li>
              <?php if(($identity != '') AND ($identity == 'teacher')): ?><li><a href="/jiaolianyuan/Home/Coach/coach.html">个人中心</a></li><?php endif; ?>
			  <?php if(($identity != '') AND ($identity == 'student')): ?><li><a href="/jiaolianyuan/Home/Student/student.html">个人中心</a></li><?php endif; ?>
			  <?php if(($identity == '') OR ($identity != 'student' AND $identity != 'teacher')): ?><li><a href="/jiaolianyuan/Home/Login/login.html" onclick="warn()">个人中心</a></li><?php endif; ?>       
        </ul>
         <div class="information">
        	<p>消息</p><img  src="/jiaolianyuan/Public/images/消息 (2).png"/><div class="red_dott"><span><?php echo ($unReadMsgNum); ?></span></div>       <!--这里要改-->
        </div>
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
			<!--<a href="javascript:postwith('/jiaolianyuan/Home/Student/test',{'room_id':'{$coachesList[0]['face']}'})" onclick="aaa()">zsdfdsaf</a>-->
	
	<div class="user">
    	<a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" alt="用户头像"/></a>
    	<span><?php echo ($name); ?></span>
        <p class="school"><?php echo ($studentBasicInfo[0]['school']); ?></p> 
        <p>账户余额:<span>￥<?php echo ($studentBasicInfo[0]['account']); ?></span></p> 
   </div>
        
     
     
     
</div>
<!--主要内容-->
<div id="main">
	<!--内容的左边栏-->
	<div class="main_left" >
    <div class="main-left" id="main-left">
        <ul class="content_list">
            <li class="select"  ><a href="#"><img src="/jiaolianyuan/Public/images/student-center-img/class.png" alt=""/>班级</a></li>
            <li><a href="#"><img src="/jiaolianyuan/Public/images/student-center-img/ques.png" alt=""/>教练</a></li>
            
            <li><a href="#"><img src="/jiaolianyuan/Public/images/student-center-img/dynamic.png" alt=""/>通知</a></li>
         <!--    <li class="none"></li>
            <li><a href="#"><img src="student-center-img/data.png" alt=""/>基本资料</a></li>
            <li><a href="#"><img src="student-center-img/set.png" alt=""/>账号设置</a></li> -->
           <li><a href="#"><img src="/jiaolianyuan/Public/images/student-center-img/set.png" alt=""/>账号设置</a></li> 
        </ul>
     </div>
    </div>
      <!--内容右边班级的信息-->
     <div class="left-tab" id="left-tab">
	     <article style="display:block;">
	     <div class="main_right class">
	        <h2>班 级 ：</h2>
	        <ul class="item_list" style="display:block;">
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂无班级" ;else: foreach($__LIST__ as $key=>$getClassList): $mod = ($i % 2 );++$i;?><li>
		                <a href="/jiaolianyuan/Home/Student/student2/classId/<?php echo ($getClassList['id']); ?>.html">
		                    <img src="/jiaolianyuan/Public/images/<?php echo ($getClassList['classpic']); ?>" alt="班级头像" width="218" height="149"/>
		                    <!--<img src="/jiaolianyuan/Public/images/student-center-img/item_pic/1.png" alt="班级头像"/>-->
		                    <h3><?php echo ($getClassList['classname']); ?></h3>
		                    <!--<?php if(($getClassList['graduatestatus'] == '0')): ?><span>未毕业</span> <a href="/jiaolianyuan/Home/Student/pauseStudy/classId/<?php echo ($getClassList['id']); ?>" >选择肄业</a><?php endif; ?>-->
		                    <?php if(($getClassList['graduatestatus'] == '0')): ?><span>未毕业</span> <a class="yiye" onclick="confirm('确定肄业？')?location.href='/jiaolianyuan/Home/Student/pauseStudy/classId/<?php echo ($getClassList['id']); ?>.html':''" href="javascript:;">选择肄业</a><?php endif; ?>
		                    <?php if(($getClassList['graduatestatus'] == '1')): ?><span>已毕业</span><?php endif; ?>    
		                    <?php if(($getClassList['graduatestatus'] == '2')): ?><span>已肄业</span><?php endif; ?>
		                </a>
		            </li><?php endforeach; endif; else: echo "暂无班级" ;endif; ?>
	          <!--页码-->
	            <?php echo ($page); ?>
	        </ul>
	     </div>
	     </article>

    

     <!--内容右边问答部分-->
     <article style="display:none;">
	     <div class="main_right ques">
	        <ul class="coach_list">
				<!--循环遍历学员的教练列表-->
				<?php if(is_array($coachesList)): $i = 0; $__LIST__ = $coachesList;if( count($__LIST__)==0 ) : echo "您暂无教练" ;else: foreach($__LIST__ as $key=>$coachesList): $mod = ($i % 2 );++$i;?><li>
						 <a href="/jiaolianyuan/Home/Index2/index2/room_id/<?php echo ($coachesList['id']); ?>.html">
		                    <img src="/jiaolianyuan/Public/images/<?php echo ($coachesList['face']); ?>" alt=""/>                 
		                    <h2><?php echo ($coachesList['tname']); ?></h2>
		                    <p><?php echo ($coachesList['onlinetime']); ?></p>
		                </a>
		            </li><?php endforeach; endif; else: echo "您暂无教练" ;endif; ?>
	            <!--页码-->
	            <?php echo ($page); ?>
	        </ul>  
	     </div>
     </article>
     
     
      <!--内容右边主页的信息-->
   
        <article style="display:none;">
          <div class="main_right home">
	         <h2>通知栏</h2>
	        <div class="new_info">
	        	<ul>
				      <?php if(is_array($messageData)): $i = 0; $__LIST__ = $messageData;if( count($__LIST__)==0 ) : echo "您暂无消息" ;else: foreach($__LIST__ as $key=>$messageData): $mod = ($i % 2 );++$i;?><li id="title<?php echo ($messageData['id']); ?>">
  	        			<div class="system_time"><p><?php echo ($messageData['time']); ?></p></div>
  	        		     <a href="javascript:;">
      	        			<div class="backstate_info">
      	        				<p><?php echo ($messageData['sendername']); ?>:<a href="/jiaolianyuan/Home/Student/messageDetail/id/<?php echo ($messageData['id']); ?>.html"><?php echo (html_entity_decode($messageData['content'])); ?></a></p>
      	        			</div>
  	        		     </a>
  	        		</li><?php endforeach; endif; else: echo "您暂无消息" ;endif; ?>
	        	</ul>
	        </div>
	        <div class="creater">
        		<script type="text/plain" id="myEditor" style="width:800px;height:180px;">
  
</script>
        <!--</div>
        <div class="reply">
        	<input type="button" value="回复" />
        </div>
   
       </div>-->
    </article>
     
     <!--账号信息的设置-->
     <article style="display: none;">
   	<div class="main_right set">
   			<form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/Home/Student/change_info">
   				<label class="tips_all tips_img">头像：</label>
   				<div class="header_photo" id="imgdiv">
   					<img id="pic" src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" width="120" height="120"/>
   				</div>
   				<div class="flies">
   					<a href="javascript:void(0)" >更换头像
   					<input  class="hide" type="file" accept="/jiaolianyuan/Public/images/*" value="yes" name="face" title="更换头像" id="upload"/>
   					</a>
   				</div>
   			<!--</form>
   			<form>-->
   				<?php if(($stuName != '')): ?><div class="set_realName">
   					<label class="tips_all tips_realName">姓名：</label> <?php echo ($stuName); ?>
   					<!--<input type="text" name="name" placeholder="你的真实姓名！" maxlength="16" />-->
   				</div>
   				<?php else: ?>
   				<div class="set_realName">
   					<label class="tips_all tips_realName">姓名：</label>
   					<input type="text" name="name" placeholder="真实姓名,只能修改一次，重名请添加任意字符" maxlength="16" />
   				</div><?php endif; ?>
   				<div class="set_sex">
   					<label class="tips_all tips_sex">性别：</label>
   					<label><input type="radio" name="sex" value="0"/ checked="checked">男</label>
   					<label><input type="radio" name="sex" value="1"/>女</label>
   				</div>
   				<div class="set_password">
   					<label class="tips_all tips_password">密码：</label>
   					<a href="javascript:show()" id="change_password">修改密码&gt;</a>
   					<div class="set_modal">
   						<div class="modal_form" id="modal_form">
   							<p>修改密码</p>
   							<!--<form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/Home/Student/change_password">-->
   								<div class="origin_password">
   									<label class="change_all" >输入原始密码：</label>
   										<input class="same_input" type="password" name="oldpassword" value="" placeholder="输入原始密码" />
   									
   								</div>
   								<div class="new_password">
   									<label class="change_all">输入新密码：</label>
   										<input class="same_input"  type="password" name="newpassword" value="" placeholder="输入新密码" />
   									
   								</div>
   								<div class="second_password">
   									<label class="change_all">再次输入新密码：</label>
   										<input class="same_input"  type="password" name="checkpassword" value="" placeholder="再次输入新密码" />
   									
   								</div>
   								<div class="save_btn">
   									<label>
   										<input type="submit" name="savepassword" value="确定" />
   									</label>
   								</div>
   								<div class="reset_btn">
   									<label>
   										<input type="reset" name="reset" value="取消" onclick="hide()"/>
   									</label>
   								</div>
   							<!--</form>-->
   							<div class="close_btn">
   								<a href="javascript:hide()"><img src="/jiaolianyuan/Public/images/close.png"/></a>
   							</div>
   						</div>
   						
   					</div>
   				</div>
   				<div class="set_city">
   					<label class="tips_all tips_city">城市：</label>
   					
   				</div>
   				
   				<div class="set_introduce">
   					<label class="tips_all tips_introduce">个人介绍：</label>
   					<textarea placeholder="介绍一下自己吧！" name="tIntro"></textarea>
   				</div>
   				<div class="set_btn">
   					<input type="submit" value="保存" name="btnSubmit" />
   				</div>
   			</form>
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
<script>

 var modal_form = document.getElementById('modal_form');
 var mask = document.getElementById('mask');
     function show()
     {
         modal_form.style.display = "block";
         mask.style.display = "block";
     
     }
     function hide()
     {
         modal_form.style.display = "none";
        mask.style.display = "none";
     }
$(function(){
	$("#change_password").click(function(){
		$("#mask").css({
			display:"block",height:$(document).height()
		});
	})
})
 </script>
   			<form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/Home/Student/testt">
        </div>
        <div class="reply">
        	<button type="submit" id="submit1" />发送</button>
        </div>
   
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
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UM.getEditor('myEditor').getContentTxt());
        alert(arr.join("\n"));
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

</form>
</body>
</html>