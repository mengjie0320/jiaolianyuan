<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class CoachController extends CoachcommonController {
    public function coach(){

			$name = $_SESSION['name'];
			$face = $_SESSION['face'];
		    $identity = $_SESSION['identity'];
			//梦杰修改
			$teacher = M('teacher');
//			$map['phone'] = $_SESSION['phone'];
            $map['phone'] = '01234567893';
            $c_name = $teacher ->where($map) ->select();
//			var_dump($c_name);
			$tName = $c_name[0]['tname'];
			$this->assign('tName',$tName);
			//修改结束
	        $this->assign('name',$name);
			$this->assign('face',$face);
		    $this->assign('identity',$identity);
			
			$teacherBasicInfo = $this -> getCoachBasicInfo();
			$this->assign('teacherBasicInfo',$teacherBasicInfo);
		
//		    $classList = $this -> getClass();
//			$this->assign('classList',$classList);
			
			//全部学生
			$graduatedStudents = $this -> getStudentListt();
			$this->assign('graduatedStudents',$graduatedStudents);
			
			//未毕业
//			$unGraduatedStudents = $this -> getGraduatedStudent(0);
//			$this->assign('unGraduatedStudents',$unGraduatedStudents);
			
	        //消息   +++++
		 	$messageData = $this -> allTitle();
			$this -> assign('messageData',$messageData);
			
			// 未读消息个数++++
		    $unReadMsgNum = $this -> unReadMsgNum();
		    $this -> assign('unReadMsgNum',$unReadMsgNum);
				
		    $this -> display();
		
	}
	
	/*
	 * 获取教练基本信息，教练用户名不能重复
	 */
	public function getCoachBasicInfo()
	{
		$teacher = M('teacher');
		$where['tName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		$teacherData = $teacher -> field('id,address') ->where($where) ->select();
		if(!$teacherData)
		{
		$teacherData = $teacher -> field('id,address') ->where($where2) ->select();
			
		}
		return $teacherData;
	}
	
	/*
	 * 获取教练带的班级和该班级选他的学生
	 */
//	public function getClassAndStudentList()
//	{
//		$teacher = M('teacher');
//      $model = new Model();
//		//用户名登录
//      $where['tName'] = $_SESSION['name'];
//		//手机登录
//		$where2['phone'] = $_SESSION['name'];
//		$classId = $_GET['classId'];
//		$classId = (int)($classId);
//		//用户名登录
//		$teacherId = $teacher -> field('id') -> where($where) -> select();
//		//判断是手机登录的
//		if(!$teacherId)
//		{
//		$teacherId = $teacher -> field('id') ->where($where2) ->select();
//		}
//		
//		
//		$teacherId = (int)($teacherId[0]['id']);
//		$data = $model -> query("select classId,className,stuId,stuName,face from (((select classId,stuId from `stu_class` where teacherId=$teacherId)as a left join student on a.stuId=student.id)  left join class on classId=class.id) where class.id=$classId");
//      if ($data  != NULL) 
//      {
//      $return["ret"] = "200";
//		$return["data"] = $data;
//		$return["msg"] = "";
//		// S("$cname",$return,120); //写入缓存，时间120s  
//		$this -> ajaxReturn($return);
//		}
//		else
//		{
//		$return["ret"] = "400";
//		$return["data"] = "您在这个班级尚无学生";
//		$return["msg"] = "";
//      //S("$cname",$return,120); //写入缓存，时间120s  
//		$this -> ajaxReturn($return);
//		}
//		
//	}
	
	
	/*
	 * 获取某个老师的班级
	 */
//	public function getClass()
//	{
//		$teacher = M('teacher');
//      $model = new Model();
//      $where['tName'] = $_SESSION['name'];
//		$where2['phone'] = $_SESSION['name'];
//      $teacherId = $teacher -> field('id') -> where($where) -> select();
//		if(!$teacherId)
//		{
//		$teacherId = $teacher -> field('id') ->where($where2) ->select();
//		}
//		$teacherId = (int)($teacherId[0]['id']);
//		$data = $model -> query("select className,id from class where id in (select classId from `stu_class` where teacherId=$teacherId)");
//	    return $data;
//	}
	
	/*
	 * 获取某个老师的全部学生
	 *
	 */
	public function getStudentListt()
	{
		//获取教练ID
		$teacher = M('teacher');
        $model = new Model();
        $where['tName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
        $teacherId = $teacher -> field('id') -> where($where) -> select();
		if(!$teacherId)
		{
		$teacherId = $teacher -> field('id') ->where($where2) ->select();
		}
		$teacherId = (int)($teacherId[0]['id']);
        //查找该教练已毕业的学生
        try{
		    $studentList = $model -> query("select stuName,face,school from `student` where id in (select stuId from `stu_class` where teacherId=$teacherId)");
		}catch(\Exception $e) {
			echo "参数错误";
		}
	    return $studentList;
	}
	
	/*
	 * 获取班级id并存在SESSION里
	 */
	public function coachProve()
	{
		    $_SESSION['classId'] = urldecode($_GET['id']);
		    $name = $_SESSION['name'];
			$face = $_SESSION['face'];
		    $identity = $_SESSION['identity'];
	        $this->assign('name',$name);
			$this->assign('face',$face);
		    $this->assign('identity',$identity);
			
			//获取申请价格区间
			$class = M('class');
			$where['id'] = urldecode($_GET['id']);
			$priceRange = $class -> field('coachMinPrice,coachMaxPrice') -> where($where) -> select();
            $this->assign('priceRange',$priceRange);
			
			
			
			
		    $this -> display();
	}
	
	/*
	 * 申请成为教练
	 */
	public function do_coachProve()
	{

			$name = $_SESSION['name'];
			$face = $_SESSION['face'];
		    $identity = $_SESSION['identity'];
	        $this->assign('name',$name);
			$this->assign('face',$face);
		    $this->assign('identity',$identity);
			
			
			
			
			//先判断教练定价是否合理
			$class = M('class');
			$where['id'] = $_SESSION['classId'];
			$priceRange = $class -> field('coachMinPrice,coachMaxPrice') -> where($where) -> select();
			$coachPrice = (int)($_POST['coachPrice']);   //提交申请的价格
			$coachMinPrice = (int)($priceRange[0]['coachminprice']);
			$coachMaxPrice = (int)($priceRange[0]['coachmaxprice']);
			if( $coachPrice < $coachMinPrice || $coachPrice > $coachMaxPrice )
			{
				$this -> error("您申请的定价不合理");
			}
			
			
            $teacher_class = M('teacher_class');
			$teacher = M('teacher');
			//获取教练id
			$where2['tName'] = $_SESSION['name'];
		    $where3['phone'] = $_SESSION['name'];
			$teacherId = $teacher -> field('id') -> where($where2) -> select();
			if(!$teacherId)
			{
			$teacherId = $teacher -> field('id') ->where($where3) ->select();
			}
            $map2['teacherId'] = (int)($teacherId[0]['id']);
            //获取班级id
            $map2['classId'] = $_SESSION['classId'];
			//判断该教练是否申请过该班级
			$confirm = $teacher_class -> where($map2) -> find();
			//该教练申请过该班级
			if($confirm == true)
			{
				$this->error('您已经是这个班级的教练，请勿重复申请', U('Home/Index/index'),3);
				session('classId',null);
			}
			//该教练没申请过该班级
			else{
			//接收数据
		    $map2['reason'] = $_POST['reason'];
		    $map2['coachPrice'] = $_POST['coachPrice'];
		    $map2['applyTime'] = date("Y-m-d");
			
			//增加申请数据
			try{
			$result = $teacher_class -> data($map2) -> add();
			session('classId',null); 
			}
			//申请异常
			catch(\exception $e)
			{
				$this->error('申请出错，请重试', U('Home/Index/index'),3);
			}
            //申请成功
            if($result>0)
			{
				$this -> success('已提交，请等待审核结果', U('Home/Index/index'),3);
				session('classId',null);
			}
			//申请失败
			else
			{
				$this->error('提交失败', U('Home/Coach/coachProve'),3);
			}
			}
			
	}
		
	public function change_info(){
		
		$teacher = M('teacher');
//		var_dump($_POST);
		
		//检测是否修改图片
        if($_POST['file'] = 'yes'){
//      	var_dump($teacher);
	        $upload = new \Think\Upload();
			//实例化上传类
			$upload -> maxSize = 3145728;
			// 设置附件上传大小 2M = 1024*1024*2=2097152 3M = 1024*1024*3=3145728
			$upload -> exts = array('jpg', 'jpeg', 'png', 'gif');
			$upload -> rootPath = './Public/images/';
			$info = $upload -> uploadOne($_FILES['face']);
        	$data['face'] = $info['savepath'].$info['savename'];
			$face2 = $data['face'];
			$_SESSION['face'] = $face2;
        }
        //检测是否更改密码
		if($_POST['savepassword'] == '确定'){
			$get['phone'] = '01234567893';
			$get = $teacher -> where($get) ->select();
			if(md5($_POST['oldpassword']) == $get[0]['password']){
				if($_POST['newpassword'] == $_POST['checkpassword']){
					$data['password'] = md5($_POST['newpassword']);
//					var_dump(md5($_POST['newpassword']));
				}else{
					echo "<script>alert('前后密码不一致，请重新输入');</script>";
				}
			}else{
				echo "<script>alert('旧密码输入错误，请重新输入');</script>";
			}
		}
//		$data['password'] = $_POST['new_password'];
        if($_POST['tIntro']!=''){
        	$data['tIntro'] = $_POST['tIntro'];
        }
       
		
		
		if($_POST['sheng']!=''||$_POST['shi']!=''||$_POST['xian']!=''){
			$p = M('province');
			$c = M('city');
			$a = M('area');
			$sheng['provinceID'] = $_POST['sheng'];
			$province = $p ->where($sheng) ->select();
			$shi['cityID'] = $_POST['shi'];
			$city = $c ->where($shi) ->select();
			$xian['areaID'] = $_POST['xian'];
			$area = $a ->where($xian) ->select();
			$data['address'] = $province[0]['province'].$city[0]['city'].$area[0]['area'];
		}
		if($_POST['day']!=''||$_POST['start_hour']!=''||$_POST['start_minute']||$_POST['finish_hour']!=''||$_POST['finish_minute']){
			$data['onlineTime'] = '星期'.$_POST['day'].'    '.$_POST['start_hour'].':'.$_POST['start_minute'].'-'.$_POST['finish_hour'].':'.$_POST['finish_minute'];
		}
//		$data['address'] = $_POST['sheng'].$_POST['shi'].$_POST['xian'];
        if($_POST['name']!=''){
        	$map['tName'] = $_POST['name'];
			$check_name = $teacher ->where($map) ->select();
			if($check_name > 0){
				echo "<script>alert('该用户名已被注册');</script>";
			}else{
				$data['tName'] = $_POST['name'];
			}
        }
		
        $data['sex'] = $_POST['sex'];
		//			$m['phone'] = $_SESSION['phone'];
		$m['phone'] = '01234567893';
//		var_dump($data);
		try{
			
          $result =	$teacher -> where($m) ->save($data);
		  if($result)
		  {
			$this->success("更改成功", U('Home/Coach/coach'),3);
		  }
       }catch(\Exception $e)
	      {
//            echo "<script>alert('异常，请重试');</script>";
              $this->error("更改失败", U('Home/Coach/coach'),3);
	      }
		  
		
	}


	/*
	 *所有消息主题，在message表
	 */
	 public function allTitle()
	 {
	 	$message = M('message');
		$model = new Model();
		$name = $_SESSION['name'];
		$where2['targetName'] = $_SESSION['name'];
//		$messageData = $message -> where() -> select();
        $messageData = $model -> query("select * from message where senderName='$name' or targetName='$name'");  
		
	    return $messageData;
		
	 }
	
	/*
	  * 获取里面有新消息的主题id,加小红点用
	  */
	 public function searchTitleId()
	 {
	 	$reply = M("reply");
		$message = M('message');
		$model = new Model();
		//获取在replay表中未读消息数目
		$where['targetName'] = $_SESSION['name'];
		$where['isRead'] = 0;
	 	$titleId = $reply ->  distinct(true) -> field('referId') -> where($where) -> select();
		
		if($titleId != null)
		{
		$return["ret"] = "200";
		$return["data"] = $titleId;
		$return["msg"] = "";
        $this -> ajaxReturn($return);  
		}
		else
		{
		$return["ret"] = "400";
		//注册失败
		$return["data"] = "";
		$return["msg"] = "";
		$this -> ajaxReturn($return);
		}   
		
	 }
	 
	 
	 /*
	  * 获取未读消息数目
	  */
	 public function unReadMsgNum()
	 {
	 	$reply = M("reply");
		$message = M('message');
		//获取在replay表中未读消息数目
		$where['targetName'] = $_SESSION['name'];
		$where['isRead'] = 0;
	 	$unReadMsgNum1 = $reply ->  where($where) -> count();
		//获取在message表中未读消息数目
//		$unReadMsgNum2 = $message ->  where($where) -> count();
		//总未读消息数目
		$unReadMsgNum = $unReadMsgNum1;
		return $unReadMsgNum;
	 }
	 
	/*
	 * 消息页面
	 */
	public function messageDetail()
	{

		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);

        $receiveMsg = $this ->  receiveMsg();
		$this->assign('receiveMsg',$receiveMsg);

		$teacherBasicInfo = $this -> getCoachBasicInfo();
		$this->assign('coachBasicInfo',$teacherBasicInfo);

		$this -> display();
	}

	/*
	 * 点击后显示所有某主题的replay信息  
	 * @param  int titleId   (referId主题id)
	 */
	 public function receiveMsg()
	{
		$reply = M('reply');
		$where['referId'] = $_GET['id'];               
		$data = $reply -> where($where) -> order('id asc') -> select();

   		//更新数据表，把未读改为已读
   		$where2['targetName'] = $_SESSION['name'];
   		$where2['isRead'] = 0;
     	$where2['referId'] = $_GET['id']; 
        $this ->  assign("referId",$_GET['id']);
   		$updateData['isRead'] = 1;
   		$updateResult = $reply -> where($where2) -> save($updateData);
   		
		return $data;
   		
	}
	
	/*
	 * 学员发消息message给管理员
	 * 
	 * 学生发送消息      注意：发该消息的id要传给模板
	 * senderType,targetType  :   0后台  1教练  2学生 
	 * @param String content
	 */
	  public function sendMsg()
	  {
		$message = M('message');
		$data['senderName'] = $_SESSION['name'];    //测试先为get
		$data['senderType'] = 1;
		$data['targetName'] = "admin";
		$data['targetType'] = "0";
		$data['content'] = I("post.content");
		$data['time'] = date('Y-m-d H:i:s');
		$data['isRead'] = 0;
        
		$result = $message->add($data); // 写入基本数据到数据库
        $this->success('发送成功');
	  }

	  
    /*
	 * 回复管理员reply
	 */
	 public function replay()
	 {
	 	$reply = M("reply");

		$data['senderName'] = $_SESSION['name'];
		$data['targetName'] = "admin";
		$data['content'] = I("post.content");
		$data['time'] = date('Y-m-d H:i:s');
		$data['isRead'] = 0;
		$data['referId'] = I("get.id");
		//echo $data['referId'];
		$result = $reply->add($data); // 写入基本数据到数据库
		if($result > 0)
		{
			$this -> success("发送成功");
		}
		else{
			$this -> error("发送失败");
		}
	 }
	

}
