<?php if (!defined('THINK_PATH')) exit();?>﻿<html>
<head>
<title>管理员登录</title>
  <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  
<meta  http-equiv="content-type" content="text/html;charset=UTF-8">
</head>
<body>
<div style="padding: 100px 100px 10px;text-align:center;"><h1><b>管理员登录</b></h1></div>
<div style="padding: 60px 100px 10px;">
   <form action="/jiaolianyuan/admin.php/Home/Index/login" method="POST" class="bs-example bs-example-form">
      <div style="width:500px;margin: 0 auto;">
	  <div class="input-group input-group-lg">
         <span class="input-group-addon">账号</span>
         <input type="text" class="form-control" name="adminName" placeholder="请输入账号"/>
      </div><br>
      <div class="input-group input-group-lg">
         <span class="input-group-addon">密码</span>
         <input type="password" class="form-control" name="password" placeholder="请输入密码"/>
      </div><br>
 </div>
   <div style="padding: 30px 100px 10px;text-align:center;"><p >
   <input type="submit" class="btn btn-default btn-lg " value="用户登录">
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="reset" class="btn btn-default btn-lg " value="重新填写">
</p></div>
  </form>
</div>
<!--
<form action="Sloginprocess.php" method="POST"> 
<table>
<tr><td>学号</td><td><input type="text" name="sno"/></td></tr>
<tr><td>密码</td><td><input type="text" name="password"/></td></tr>
<tr><td><input type="submit" value="用户登录"/></td><td><input type="reset" value="重新填写"/></td></tr>
</table>
</form>
-->

</body>

</html>

<!--<html>
<head>
<title>管理员登录</title>
<meta  http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<body background="pic/bg.gif">
<form action="loginprocess.php" method="POST"> 
<table width="298" height="120" border="0" align="center">
<tr><td colspan="2" height="350"  align="center"><h1><b>信息管理系统</b></h1></td></tr>
<tr><td height="50"  align="center">账&nbsp&nbsp号:</td><td height="50"  align="center"><input type="text" name="id" style="width:545px;height:35px"/></td></tr>
<tr><td height="50"  align="center">密&nbsp&nbsp码:</td><td height="50"  align="center"><input type="password" name="password" style="width:545px;height:35px"/></td></tr>
<tr><td height="50"  align="center"><input type="submit" value="用户登录"/></td><td height="50"  align="center"><input type="reset" value="重新填写"/></td></tr>
</table>
</form>

</body>

</html>
-->