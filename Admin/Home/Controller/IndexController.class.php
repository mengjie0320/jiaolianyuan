<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function login(){
		
		 
		$Modal = new \Think\Model();
		$map['adminName'] = I('post.adminName');
		$map['password'] = I('post.password');

		if(M('admin')->where($map)->select() != null){
			session('adminName', $map['adminName']);

			
			//echo $result[0]["count"];
			
			$this->display("homepage");  //登录成功，指定跳转的视图
		}
		else{
			$this->error("账号或密码错误，请返回重试");
		}

					
	}
	
	public function out(){
		$_SESSION=array();
		session_destroy();
		$this->redirect('Index/index');
	}

    public function index(){
		$this->display();
    }
}