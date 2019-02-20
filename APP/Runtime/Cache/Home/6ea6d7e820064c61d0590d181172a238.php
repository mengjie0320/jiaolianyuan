<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="教练缘，教练，课程">
	<meta name="description" content="教练缘为你量身订制教练学IT!">
	<title>教练缘-教练中心</title>
	<link href="/jiaolianyuan/Public/CSS/common.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/CSS/coach-center.css" rel="stylesheet"/>
	<link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
	<link href="/jiaolianyuan/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="/jiaolianyuan/Public/js/threeconnect.js"></script>
	<script src="/jiaolianyuan/Public/js/uploadPreview.js" type="text/javascript"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/threeconnect.js"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/coachcenter.js"></script>
	<script src="/jiaolianyuan/Public/js/uploadPreview.js" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8" src="/jiaolianyuan/Public/umeditor/umeditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/jiaolianyuan/Public/umeditor/umeditor.min.js"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/umeditor/lang/zh-cn/zh-cn.js"></script>

<!--给有未读信息的主题加个小红点-->
<script>
        $(function(){
          var searchContent = $("#searchContent").val();
      
      $.ajax({
          contentType:"application/json",
          type : "get",
          url : "searchTitleId",
          dataType : "json",
          cache : "false",
          async : true,
          success : function(datac){
                     if(datac.ret == 200)
                      {
			            for (var i=0;i<datac.data.length;i++) 
			            {
			               $("#title"+datac.data[i]['referid']).append("<img class='little_circle' src='/jiaolianyuan/Public/images/student-center-img/new_message.png'/>");
			            }
			          }
          },
          error: function(datac){
            alert("出错啦")
          }
          });
       })
          
</script>
</head>

        <!--获取班级下的学员列表-->
        <!--<script>
                $(function(){
                    $(".class_list a").click(function(){
                var classId = $(this).attr("id");
                $.ajax({
                    contentType:"application/json",
                    type:"get",
                    url:"http://localhost/jiaolianyuan/index.php/Home/Coach/getClassAndStudentList",
                    data:{"classId":classId},
                    dataType:"json",
                    cache:"false",
                    async:true,
                    success: function(datac){
                     $('.stu_list li').detach();
                     if(datac.ret == 200)
                      {
                        for (var i=0;i<datac.data.length;i++) {
                            $('.stu-list ul').append('<li> <a href="#"> <img src="/jiaolianyuan/Public/images/'+datac.data[i].face+'" alt="学员头像" width="130" height="130" /><h3>'+datac.data[i].stuname+'</h3><p>某地方某学校</p></a></li>');
                             }
                       }
                       else
                       {
                            $('.children-list ').append('<li><a href="javascript:;">'+datac.data+'</a></li>');
                       }
                    },
                    error: function(datac){
                        alert("出错啦")
                    }
            });
            
//                  
            });
                })
                    
</script>-->
<script>
    $(document).ready(function(){
        //<tr/>居中
        $("#tab tr").attr("align","center");
        
        //增加<tr/>
        $("#but").click(function(){
            var _len = $("#tab tr").length;   
//          alert(_len);
            $("#tab").append("<tr id="+_len+"><td><select id='desc"+_len+"'><option value='0'>星期</option><option value='1'>星期一</option><option value='2'>星期二</option><option value='3'>星期三</option><option value='4'>星期四</option><option value='5'>星期五</option><option value='6'>星期六</option><option value='7'>星期日</option></select><select id='starhour"+_len+"'><option value='0'>小时</option><option value='1'>00</option><option value='2'>01</option><option value='3'>02</option><option value='4'>03</option><option value='5'>04</option><option value='6'>05</option><option value='7'>06</option><option value='8'>07</option><option value='9'>08</option><option value='10'>09</option><option value='11'>10</option><option value='12'>11</option><option value='13'>12</option><option value='14'>13</option><option value='15'>14</option><option value='16'>15</option><option value='17'>16</option><option value='18'>17</option><option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='22'>21</option><option value='23'>22</option><option value='24'>23</option></select><label style='text-align: center;margin-left: 5px;'>:</label><select id='starmin"+_len+"'><option value='0'>分钟</option><option value='1'>00</option><option value='2'>01</option><option value='3'>02</option><option value='4'>03</option><option value='5'>04</option><option value='6'>05</option><option value='7'>06</option><option value='8'>07</option><option value='9'>08</option><option value='10'>09</option><option value='11'>10</option><option value='12'>11</option><option value='13'>12</option><option value='14'>13</option><option value='15'>14</option><option value='16'>15</option><option value='17'>16</option><option value='18'>17</option><option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='22'>21</option><option value='23'>22</option><option value='24'>23</option></select><label style='text-align: center;margin-left: 5px;'>—</label><select id='starhours"+_len+"'><option value='0'>小时</option><option value='1'>00</option><option value='2'>01</option><option value='3'>02</option><option value='4'>03</option><option value='5'>04</option><option value='6'>05</option><option value='7'>06</option><option value='8'>07</option><option value='9'>08</option><option value='10'>09</option><option value='11'>10</option><option value='12'>11</option><option value='13'>12</option><option value='14'>13</option><option value='15'>14</option><option value='16'>15</option><option value='17'>16</option><option value='18'>17</option><option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='22'>21</option><option value='23'>22</option><option value='24'>23</option></select><label style='text-align: center;margin-left: 5px;'>:</label><select id='starmins"+_len+"'><option value='0'>分钟</option><option value='1'>00</option><option value='2'>01</option><option value='3'>02</option><option value='4'>03</option><option value='5'>04</option><option value='6'>05</option><option value='7'>06</option><option value='8'>07</option><option value='9'>08</option><option value='10'>09</option><option value='11'>10</option><option value='12'>11</option><option value='13'>12</option><option value='14'>13</option><option value='15'>14</option><option value='16'>15</option><option value='17'>16</option><option value='18'>17</option><option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='22'>21</option><option value='23'>22</option><option value='24'>23</option></select></td><td><a href=\'javascript:void(0);\' onclick=\'deltr("+_len+")\'>删除</a></td></tr>");

// 			$('tr select').css('margin-left','10px');				
                                
                                      
        })  
        //删除<tr/>
   
        
    })
     var deltr =function(index)
    {
        var _len = $("#tab tr").length;
        $("tr[id='"+index+"']").remove();//删除当前行
        for(var i=index+1,j=_len;i<j;i++)
        {
            var nextTxtVal = $("#desc"+i).val();
            $("tr[id=\'"+i+"\']")
                .replaceWith("<tr id="+(i-1)+"><td><select id='desc"+(i-1)+"'><option value='0'>星期</option><option value='1'>星期一</option><option value='2'>星期二</option><option value='3'>星期三</option><option value='4'>星期四</option><option value='5'>星期五</option><option value='6'>星期六</option><option value='7'>星期日</option></select><select id='starhour"+(i-1)+"'><option value='0'>小时</option><option value='1'>00</option><option value='2'>01</option><option value='3'>02</option><option value='4'>03</option><option value='5'>04</option><option value='6'>05</option><option value='7'>06</option><option value='8'>07</option><option value='9'>08</option><option value='10'>09</option><option value='11'>10</option><option value='12'>11</option><option value='13'>12</option><option value='14'>13</option><option value='15'>14</option><option value='16'>15</option><option value='17'>16</option><option value='18'>17</option><option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='22'>21</option><option value='23'>22</option><option value='24'>23</option></select><label style='text-align: center;margin-left: 5px;'>:</label><select id='starmin"+(i-1)+"'><option value='0'>分钟</option><option value='1'>00</option><option value='2'>01</option><option value='3'>02</option><option value='4'>03</option><option value='5'>04</option><option value='6'>05</option><option value='7'>06</option><option value='8'>07</option><option value='9'>08</option><option value='10'>09</option><option value='11'>10</option><option value='12'>11</option><option value='13'>12</option><option value='14'>13</option><option value='15'>14</option><option value='16'>15</option><option value='17'>16</option><option value='18'>17</option><option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='22'>21</option><option value='23'>22</option><option value='24'>23</option></select><label style='text-align: center;margin-left: 5px;'>—</label><select id='starhours"+(i-1)+"'><option value='0'>小时</option><option value='1'>00</option><option value='2'>01</option><option value='3'>02</option><option value='4'>03</option><option value='5'>04</option><option value='6'>05</option><option value='7'>06</option><option value='8'>07</option><option value='9'>08</option><option value='10'>09</option><option value='11'>10</option><option value='12'>11</option><option value='13'>12</option><option value='14'>13</option><option value='15'>14</option><option value='16'>15</option><option value='17'>16</option><option value='18'>17</option><option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='22'>21</option><option value='23'>22</option><option value='24'>23</option></select><label style='text-align: center;margin-left: 5px;'>:</label><select id='starmins"+(i-1)+"'><option value='0'>分钟</option><option value='1'>00</option><option value='2'>01</option><option value='3'>02</option><option value='4'>03</option><option value='5'>04</option><option value='6'>05</option><option value='7'>06</option><option value='8'>07</option><option value='9'>08</option><option value='10'>09</option><option value='11'>10</option><option value='12'>11</option><option value='13'>12</option><option value='14'>13</option><option value='15'>14</option><option value='16'>15</option><option value='17'>16</option><option value='18'>17</option><option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='22'>21</option><option value='23'>22</option><option value='24'>23</option></select></td><td><a href=\'javascript:void(0);\' onclick=\'deltr("+(i-1)+")\'>删除</a></td></tr>");
        }    
         
    }
//  $(function(){
//  	$("#tab tr:nth-child(even)").addClass("trodd");
//  })
   
</script>
<body>
<!--导航栏-->
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
        <div class="information">
        	<p>消息</p><img  src="/jiaolianyuan/Public/images/student/mes.png"/><div class="red_dott"><span><?php echo ($unReadMsgNum); ?></span></div>       <!--这里要改-->
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

<div id="user_warp">
	<div class="user">
		<a href="#"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" alt="用户头像" width="90" height="90" /></a>    	
		<span><?php echo ($name); ?></span>
        <p class="school"><?php echo ($teacherBasicInfo[0]['address']); ?></p>
    </div>
</div>
<!--主要内容-->
<div id="main">
	<!--内容的左边栏-->
	<div class="main-left" id="main-left">
    	<ul class="content_list">
        	<li class="select"><a href="#"><img src="/jiaolianyuan/Public/images/coach-center-img/dynamic.png" alt="通知"/>通知</a></li>
            <li><a href="#"><img src="/jiaolianyuan/Public/images/coach-center-img/ques.png" alt="学员"/>学员</a></li>
            <li><a href="#"><img src="/jiaolianyuan/Public/images/coach-center-img/set.png" alt="账号设置"/>账号设置</a></li>
            <a class="enter" href="/jiaolianyuan/Home/Index2/index2/room_id/chat.html" target="_blank"><img src="/jiaolianyuan/Public/images/coach-center-img/enter.png" alt="答疑入口"/>答疑入口</a> 
        </ul>
        
    </div>
    <!--内容右边通知栏的信息-->
    <div class="left-tab" id="left-tab" name="left-tab">
        <article >
          <div class="main_right home">
	         <h2>通知栏</h2>
	        <div class="new_info">
	        	<ul>
				      <?php if(is_array($messageData)): $i = 0; $__LIST__ = $messageData;if( count($__LIST__)==0 ) : echo "您暂无消息" ;else: foreach($__LIST__ as $key=>$messageData): $mod = ($i % 2 );++$i;?><li >
  	        			<div class="system_time"><p><?php echo ($messageData['time']); ?></p></div>
  	        		     <a href="javascript:;">
      	        			<div id="title<?php echo ($messageData['id']); ?>" class="backstate_info">
      	        				<p><?php echo ($messageData['sendername']); ?>:<a href="/jiaolianyuan/Home/Coach/messageDetail/id/<?php echo ($messageData['id']); ?>.html"><?php echo (html_entity_decode($messageData['content'])); ?></a></p>
      	        			</div>
  	        		     </a>
  	        		</li><?php endforeach; endif; else: echo "您暂无消息" ;endif; ?>
	        	</ul>
	        </div>
		        <form id=""  method="post" action="/jiaolianyuan/Home/Coach/sendMsg">
			      	<div class="creater">
						<script type="text/plain" name="content" id="myEditor" style="width:800px;height:180px;"></script>
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
						
						</script>
					
				</form>
		        <!--</div>
		        <div class="reply">
		        	<input type="button" value="回复" />
		        </div>
		       </div>-->
    	</article>
         
   
    <!--内容右边班级的信息-->
    <article style="display:none;">
       <div class="main_right class">
       <div class="class-list" id="class_list">

       </div>
      
      <!--学员列表-->
        <h2>全部</h2>
        <div class="stu-list" id="stu-list">
         <ul class="stu_list" style="display:block;">
		    <?php if(is_array($graduatedStudents)): $i = 0; $__LIST__ = $graduatedStudents;if( count($__LIST__)==0 ) : echo "暂无学员" ;else: foreach($__LIST__ as $key=>$graduatedStudents): $mod = ($i % 2 );++$i;?><li>
                <img src="/jiaolianyuan/Public/images/<?php echo ($graduatedStudents['face']); ?>" alt="学员头像" width="130" height="130" />
                
                <a href="#">
				    <a href="">
                	
                    <h3><?php echo ($graduatedStudents['stuname']); ?></h3>
                    <p><?php echo ($graduatedStudents['school']); ?></p>
                </a>
            </li><?php endforeach; endif; else: echo "暂无学员" ;endif; ?>
           
        </ul>

     </div>
     </div>
    </article>
    <article style="display: none;">
   	<div class="main_right set">
   			<form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/Home/Coach/change_info.html">
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
   				<?php if(($tName != '')): ?><div class="set_realName">
   					<label class="tips_all tips_realName">姓名：</label> <?php echo ($tName); ?>
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
   							<!--<form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/Home/Coach/change_password">-->
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
   								<a href="javascript:hide()">关闭</a>
   							</div>
   						</div>
   						
   					</div>
   				</div>
   				<div class="set_city">
   					<label class="tips_all tips_city">城市：</label>
   					
   				</div>
   				<!--<div class="set_time">
   					<label class="tips_all tips_time">值班时间：</label>
   					
   					<table width="550px" id="tab" align="center" cellspacing="10">
   						<tr>
   							<td>
   					<select name="day">
   						<option value="0">星期</option>
   						<option value="1">星期一</option>
   						<option value="2">星期二</option>
   						<option value="3">星期三</option>
   						<option value="4">星期四</option>
   						<option value="5">星期五</option>
   						<option value="6">星期六</option>
   						<option value="7">星期日</option>
   					</select>
   					<select name="start_hour">
   						<option value="0">小时</option>
   						<option value="1">00</option>
   						<option value="2">01</option>
   						
   					</select><label style="text-align: center;margin-left: 5px;">:</label>
   					<select  name="start_minute">
   						<option value="0">分钟</option>
   						<option value="1">00</option>
   						<option value="2">01</option>
   					</select><label style="text-align: center;margin-left: 5px;">—</label>
   					<select name="finish_hour">
   						<option value="0">小时</option>
   						<option value="1">00</option>
   						<option value="2">01</option>
   					</select><label style="text-align: center;margin-left: 5px;">:</label>
   					<select name="finish_minute">
   						<option value="0">分钟</option>
   						<option value="1">00</option>
   						<option value="2">01</option>
   					</select>
   							</td>
   							
   						</tr>
   						
   					</table>
   					 <div class="add_btn">
				        <input type="button" id="but" value="增加"/>
				    </div>
   				</div>-->
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

</body>
</html>