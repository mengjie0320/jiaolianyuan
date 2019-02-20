<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class StudentcommonController extends Controller {
  function _initialize(){
      if($_SESSION['identity'] == null || $_SESSION['identity'] != "student")
		   {
            $this->error('请先登录', U('Home/Login/login'),1);
		   }
     }      
 }
