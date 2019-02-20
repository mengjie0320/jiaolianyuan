<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>教练缘-欢迎登录</title>
<link href="/jiaolianyuan/Public/images/public/logo.ico"rel="icon" />
<link href="/jiaolianyuan/Public/CSS/login.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="/jiaolianyuan/Public/js/jquery-2.2.1.min.js"></script>
<script src="/jiaolianyuan/Public/js/myajax.js" type="text/javascript"></script>
</head>


<script>

</script>


<!--验证码切换-->
<script>
	function changeVerify()
	{
		
	    $('.codes-img img').detach();
	    var Rand = Math.random(); 
	    var src = "/jiaolianyuan/index.php/Home/Login/verify/tm="+Math.random();
	    $('.codes-img').append('<img src='+src+' alt="验证码" onclick="changeVerify()" />');
	
	}

</script>
<body >
<!--logo-->
<div id="top">
	<div id="logo">
    	<a href="/jiaolianyuan/index.php/Home/Index/index.html" target="_blank"><img  src="/jiaolianyuan/Public/images/public/logo.png" alt="教练缘" /></a>
    </div>
</div>


<div id="warp">
	<div id="bg-pic">
    	<div id="login">
        	<div class="login-form">
                <h2>登录教练缘</h2>
                <a href="/jiaolianyuan/index.php/Home/register/register.html">注册</a>
                <form id="" enctype="multipart/form-data" method="post" action="/jiaolianyuan/index.php/Home/Login/do_login">
                    <div class="login-box">
                        <span id="user-pic"class="login-label name-label" for="loginname"></span>
                        <input class="login" id="login-name" type="text" autofocus="autofocus" name="login-name" required="required" placeholder="用户名/手机号码"/>
                    </div>
                    <div class="login-box">
                        <label id="pwd-pic"class="login-label pwd-label" for="loginpwd"></label>
                        <input class="login" id="login-pwd" type="password" name="login-pwd" required="required" placeholder="密　码"/>
                    </div>              
                    <!--验证码框及其显示-->
                    <div class="codes-box">
                     	<span id="verify"class="login-label name-label" for="verify"></span>
                        <input class="" id="verify" type="text" name="verify" placeholder="验证码" onkeyup="check_verify(this.value)"/>
                        <!--存放验证码验证结果-->
                        <p id="verify_result"></p>
                      </div>
                    <div class="codes-img">
                    	<img src="/jiaolianyuan/index.php/Home/Login/verify" id="verify" alt="验证码" onclick="changeVerify()" />
                    </div>
                    <br />
                    <span class="checked-1">
                       <input class="checked" type="radio" name="position" checked="checked" name="user"  value="trainee">学员
                   </span>
                   <span class="checked-2">
                       <input class="checked" type="radio" name="position"  name="user"  value="coach">教练
                    </span>
                    <button type="submit" name="login-btn" id="login-btn"></button>
                </form>
            </div>
            <div class="safe">
                <input id="remember-me" class="remember" type="checkbox" />
                <label for="">记住我</label>
                <a  id="forget-pwd" class="" target="_blank" href="#">忘记密码？</a>      
            </div>
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
</body>
</html>