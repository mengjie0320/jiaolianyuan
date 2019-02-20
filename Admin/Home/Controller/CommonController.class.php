<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller
use Think\Controller
class CommonController extends Controller {
    
	public function _initialize(){
      // var_dump($_SESSION['name']);
	  if(!isset($_SESSION['adminName']) || $_SESSION['adminName']==''){
		  $this->redirect("../admin.php");
		  //$this->success('登录失败！', "__ROOT__/index.php/Index/Alogin.html");
	  }
	}
	 
}

?>