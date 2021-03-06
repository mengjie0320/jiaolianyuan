<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>教练缘--个人注册</title>
	<link href="/jiaolianyuan/Public/images/public/logo.ico"rel="icon" />
	<link href="/jiaolianyuan/Public/CSS/register.css" rel="stylesheet" type="text/css"/>

	<script src="/jiaolianyuan/Public/js/myajax.js" type="text/javascript"></script>
	<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>	
</head>
<body >
<div id="top">
	<div id="logo">
    	<a href="/jiaolianyuan/index.php/Home/Index/index.html" target="_blank"><img  src="/jiaolianyuan/Public/images/public/logo.png" alt="教练缘" /></a>
    </div>
</div>

<div id="warp">
	<div id="bg-pic">
    	<div id="register">
        	<div class="register-form">
                <h2>用户注册</h2>
                <b>已有账号>></b><a  href="/jiaolianyuan/index.php/Home/Login/login.html" >马上登录</a>
               
               <button id="codes-btn"  name="get-codes" >获取短信验证码</button>
               <p style="display: none;" id="showText">
            	校验码已发出，请注意查收短信，如果没有收到</br>您可以在<span id="showTime"></span>秒后要求系统重新发送......
            	</p>
               	
              <!--不能放在form表单，不然会做提交操作-->
              <!--显示发送中字样-->
              <p id = "getPhoneCodeResult"></p>   
              
              <form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/index.php/Home/Register/do_register.html">
                     <div class="register-box">
                        <input class="register" id="register-phone" type="tel" pattern="[0-9]{11}" name="register-phone" placeholder="手机号码" required="required" onblur = "checkPhone(this.value)"  />
                        <p id = "checkRemind" ></p>   
                     </div>
                     <div class="codes-box">
                        <input class="codes" id="mes-codes" type="text" name="mes-codes" placeholder="短信验证码" required="required" onblur = "checkPhoneCode(this.value)" />
                         <!--检测手机验证码结果显示-->
                     <p id = "checkPhoneCode" ></p> 
                     </div>
                     <div class="register-box">
                        <input class="register" id="real-name" type="text" name="real-name" placeholder="用户名" required="required" onblur = "checkRealName(this.value)" />
                     </div>
                      <!--真实姓名检测是否被注册结果显示-->
                     <p id = "checkRealName" ></p> 
                     <div class="register-box">
                        <input class="pwd" id="set-pwd" type="password" name="set-pwd" placeholder="设置密码" required="required"/>
                     </div>
                     <div class="register-box">
                        <input class="pwd" id="confirm-pwd" type="password" name="confirm-pwd" placeholder="确认密码"  required="required"/>
                     </div>
                    <span class="checked-1">
                       <input class="checked" type="radio" name="position" checked="checked"   value="student"> 学员
                    </span>
                    <span class="checked-2">
                       <input class="checked" type="radio" name="position"   value="coach"> 教练
                    </span>
                    <button name="register-btn" id="register-btn" type="submit"></button>
                </form>
           </div>
          <div class="clause">
            <span> 
            	<form action="" method="get">
                    <input id="agree-clause" class="agree-clause" type="checkbox" value="clause" checked="checked"/>
                    <label for="">我已同意并接受</label><a id="" class="" target="_blank" href="#">《教练缘服务条款》</a>
                </form>
            </span>
         </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="foot-ali">
        <a href=""> 关于我们</a>
        <b>|</b>
        <a href=""> 联系我们</a>
        <b>|</b>
        <a href=""> 企业合作</a>
        <b>|</b>
        <a href=""> 友情链接</a>
        <b>|</b>
        <a href=""> 意见反馈</a>
        <b>|</b>
        <a href=""> 人才招聘</a>
    </div>
</div>
<script type="text/javascript" src="/jiaolianyuan/Public/js/register.js"></script>
</body>
</html>