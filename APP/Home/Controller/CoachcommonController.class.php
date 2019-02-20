<?php
namespace Home\Controller;
use Think\Controller;
class CoachcommonController extends Controller {
  function _initialize(){
      if($_SESSION['identity'] == null || $_SESSION['identity'] != "teacher")
		   {
            $this->error('请先登录', U('Home/Login/login'),1);
		   }
     }      
 }
