<?php
namespace Home\Controller;
use Think\Controller;
class MessageController extends CommonController {
    public function index(){      //默认进入收件箱
        $message   = M('message'); // 实例化message对象

        //$result = $message->field("id, senderType, senderName, content, isRead")->where("senderType != 0")->select();
        
		$count   = $message->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $message->order('id')->limit($Page->firstRow.','.$Page->listRows)->field("id, senderType, senderName, content, isRead")->where("senderType != 0")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }

	public function outBox(){      //进入发件箱
        $message   = M('message'); // 实例化User对象

        //$result = $message->field("id, targetType, targetName, content, isRead")->where("targetType != 0")->select();
        
		$count   = $message->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $message->order('id')->limit($Page->firstRow.','.$Page->listRows)->field("id, targetType, targetName, content, isRead")->where("targetType != 0")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }

	public function detail(){
		
		$Model = new \Think\Model();

		$id = I("get.id");

		//当前主题的详细信息
		$sql1 = "select id, senderName, senderType, targetName, targetType, content, time, isRead from message where id = ".$id;

		//当前主题的对应全部回复
		$sql2 = "select id, senderName, targetName, content, time, isRead from reply where referId = ".$id;

		$result_1 = $Model->query($sql1);
		$result_2 = $Model->query($sql2);
		//var_dump(html_entity_decode($result_2));
		$this->assign("list_1", $result_1);
		$this->assign("list_2", $result_2);
		
		$Model->execute("update message set isRead = 1 where id = ".$id);

		$this->display();
	}

	public function add(){
		$message = M("message");

		$data['senderName'] = I("post.senderName");
		$data['senderType'] = I("post.senderType");
		$data['targetName'] = I("post.targetName");
		$data['targetType'] = I("post.targetType");
		$data['content'] = I("post.content");
		$data['time'] = date('Y-m-d H:i:s');
		$data['isRead'] = 0;

		$message->add($data); // 写入基本数据到数据库
		
        $this->success('添加成功！', 'index');
    }

	public function addReply(){
        $reply = M("reply");

		$data['senderName'] = I("post.senderName");
		$data['targetName'] = I("post.targetName");
		$data['content'] = I("post.content");
		$data['time'] = date('Y-m-d H:i:s');
		$data['isRead'] = 0;
		$data['referId'] = I("post.id");
		//echo $data['referId'];
		$reply->add($data); // 写入基本数据到数据库

		$this->success('添加回复成功！', 'index');
    }
	
	
	public function send(){
       $this->display(sendMessage);
    }

	public function checkName() {
		 $a = $_POST['name'];
		 
         $Model = new \Think\Model();
		 if($a == "2"){
		 $sql1 = "select stuName from student";
		 $res = $Model->query($sql1);
		 $this->ajaxReturn($res) ;
		 }else{ 
		 $sql1 = "select tName from teacher";
		 $res = $Model->query($sql1);
		 $this->ajaxReturn($res) ;
		 }
		
		  // for ($i= 0;$i< count($res); $i++){ 
		 
		   // echo $res[$i][name]; 
        // } ;
    }
	
	
	public function delete(){
		$Model = new \Think\Model();

		$deleteID = I("get.deleteID");
        
		M("message")->delete($deleteID);
		M("reply")->where("referId = ".$deleteID)->delete();

		$this->success('删除成功！', 'index');
		
    }
}