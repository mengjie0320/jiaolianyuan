<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class Index2Controller extends Controller {
	public function ajax(){
		$returnValue = "";
		switch($_POST['type']){
			case 0:
				$data['type'] = 0;
				$data['content'] = $_POST['word'];
				$data['roomId'] = $_POST['room_id'];
				$returnValue = "success";
				break;
			case 1:
				$image = $_POST['image'];
				$image = base64_decode($image);
				//小鹏注释:图片路径
				$image_src = 'Home/Index2/index2/room_id/Public/image/'.date("Ymdhis").rand(0,9999).'.jpg';
				file_put_contents($image_src, $image);

				$data['type'] = 1;
				$data['content'] = $image_src;
				$data['roomId'] = $_POST['room_id'];
				$returnValue = $image_src;
				break;
			case 2:
				$audio = $_POST['audio'];
				$audio = base64_decode($audio);
				//小鹏注释:语音路径
				$audio_src = 'Home/Index2/index2/room_id/Public/record/'.date("Ymdhis").rand(0,9999).'.wmv';
				file_put_contents($audio_src, $audio);

				$data['type'] = 2;
				$data['content'] = $audio_src;
				$data['roomId'] = $_POST['room_id'];
				$returnValue = $audio_src;
				break;
		}
		
		$data['userName'] = $_POST['userName'];
		$data['targetName'] = $_POST['targetName'];
		$data['time'] = date('Y-m-d H:i:s');

		if($_POST['to_client_id'] == 'offline'){
			$data['isRead'] = 0;
		}else{
			$data['isRead'] = 1;
		}

		M("chat")->add($data);

		$this->ajaxReturn($returnValue);
    }

    public function ajax_history(){
    	$result = null;
    	$Model = new \Think\Model();
    	$room_id = $_POST['room_id'];
    	$identity = $_POST['identity'];
		
		
//  	$identity = $_SESSION['identity'];
		
    	if($identity == 'student'){
    		$result = $Model->query("select * from chat where roomId = ".$room_id." and isRead = 1 order by time");
    	}else if($identity == 'teacher'){
    		$result = $Model->query("select * from chat where roomId = ".$room_id." order by time");
    		$Model->execute("update chat set isRead = 1 where roomId = ".$room_id);
    	}
    	
		$this->ajaxReturn($result);
    }

    public function ajax_unread(){
    	$Model = new \Think\Model();
    	$room_id = $_POST['room_id'];
    	$result = $Model->query("select * from chat where roomId = ".$room_id." and isRead = 0 order by time");
    	$Model->execute("update chat set isRead = 1 where roomId = ".$room_id);

		$this->ajaxReturn($result);
    }

    public function index2(){
    	$identity = $_SESSION['identity'];
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$this -> assign('face',$face);
		
    	$Model = new \Think\Model();
//  	$personId = I("get.id");
//		
//		$this->assign("id", I("get.id"));
  	   $this->assign("identity", $identity);
//  	$this->assign("identity", $identity);
    		
//  	if(I("get.identity") == "student"){
    	if($identity == "student"){
	     	
			
	     //获取学生id
		//用户名登录的
		
		$student = M('student');
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		$personId = $student -> field('id,stuName') ->where($where) ->select();
		//手机登录的
		if(!$personId)
		{
		$personId = $student -> field('id,stuName') ->where($where2) ->select();
			
		}
		$personId = (int)($personId[0]['id']);
		$this->assign("id", $personId);
		
		
    		$result = $Model->query("select a.id, a.stuName, a.roomId, b.tName as teacherName from chatroom as a left join teacher as b on a.roomId = b.id where a.stuName = (select stuName from student where id = ".$personId.")");

    		$this->assign("first_room_id", $result[0]['roomid']);
    		$this->assign("myName", $result[0]['stuname']);

    		if(isset($_GET['room_id'])){
    			
				
				
				//检查该学员是否选择了该教练，因为get参可改
    			$stu_class = M('stu_class');
    			$ifExistData['stuId'] = $personId;
    			$ifExistData['teacherId'] = $_GET['room_id'];
    			$ifExist = $stu_class -> where($ifExistData) -> find();
				if(!$ifExist)
				{
					$this->error("您未选择此教练");
				}
    			
				else
					{
				    	$teacherName = $Model->query("select tName,face from teacher where id = ".$_GET['room_id']);  //为了方便，在这加一个face
    			        $this->assign("targetName", $teacherName[0]['tname']);
    			        $this->assign("targetface", $teacherName[0]['face']);
  			        }
    		}
    		else{
    			$this->assign("targetName", $result[0]['teachername']);
    		}

    		$this->assign("allow_room_list", $result);
    		$this->display();
    	}

    	else if($identity == "teacher"){
    		
    		$room_id=$_GET['room_id'];//仅仅为了不进入目录而是进入函数
    		
			//获取教练ID
		$teacher = M('teacher');
        $model = new Model();
        $where['tName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
        $personId = $teacher -> field('id') -> where($where) -> select();
		if(!$personId)
		{
		$personId = $teacher -> field('id') ->where($where2) ->select();
		}
		$personId = (int)($personId[0]['id']);
		$this->assign("id", $personId);
			
    		$result = $Model->query("select id, tName from teacher where id = ".$personId);

    		$count = $Model->query("select COUNT(*) as count from chat where roomId = ".$personId." and isRead = 0");

    		$this->assign("room_id", $personId);  //以教练的ID为房号，并且教练只能进入自己的房间
    		$this->assign("myName", $result[0]['tname']);
    		$this->assign("unread", $count[0]['count']);  //获取教练不在线时学生发送给自己的消息个数
    		$this->display('index_teacher');

    	}
		
    }



	
}