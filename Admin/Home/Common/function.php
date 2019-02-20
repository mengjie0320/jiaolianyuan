<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    
	public function _initialize(){
		$Modal = new \Think\Model();
		$result = $Modal->query("select COUNT(*) as count from message where targetType = 0 and isRead = 0");
		$this->assign("unreadMessage", $result[0]["count"]);
      // var_dump($_SESSION['name']);
	  if(!isset($_SESSION['adminName']) || $_SESSION['adminName']==''){
		  //echo "123";
		redirect(U('Home/Index/index' ,'' ,'') ,2 ,'请先登录！');
		  //$this->success('登录失败！', "__ROOT__/index.php/Index/Alogin.html");
	  }
	}
	 
}

?>