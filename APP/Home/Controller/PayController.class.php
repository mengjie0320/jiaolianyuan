<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class PayController extends StudentcommonController {
    public function pay(){
    	
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);

        $this -> display();
		
	}
	
    /*
	 * 支付中心
	 * @param int classId
	 * @param int coach
	 */
    public function payCenter()
	{

		//没有登录
		if($_SESSION['identity'] == null)
		{
            $this->error('请先登录', U('Home/Index/index'),3);
		}
		//老师登录
		if($_SESSION['identity'] == "teacher")
		{
            $this->error('身份不符', U('Home/Index/index'),3);
		}
		//学生登录
		else
		{
			
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
			
		$classId = $_GET['classId'];
		$this -> assign('classId',$classId);  //在只选择教练时更新信息用
		$coachId = $_GET['coach'];          //获取教练的id
		
		$stu_class = M('stu_class');
		$student = M('student');
		$teacher = M('teacher');
		$class = M('class');
		$teacher_class = M('teacher_class');
		
		//获取学生id
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		//用户名登录的
		$studentId = $student -> field('id,stuName') ->where($where) ->select();
		//手机登录的
		if(!$studentId)
		{
		$studentId = $student -> field('id,stuName') ->where($where2) ->select();
		}
		}

		//检测该学员是否已经选择过班级
		$data['stuId'] = (int)($studentId[0]['id']);
		$data['classId'] = (int)($_GET['classId']);
		$confirm = $stu_class -> where($data) ->find(); 
		//该学员没有选择过该班级
		if($confirm == null && $_GET['coach'] != null)
		{
			//获取班级的名称  ,  班级价格
			$classInfo = $class -> field("id,className,classPrice,classPic,avePeriod") -> where("id=".$classId) -> select();  //班级id可能要用到
			$this -> assign('classInfo',$classInfo);
			//教练名字
			$coachName = $teacher -> field('tName') -> where('id='.$coachId) -> select();
			$coachName = $coachName[0]['tname'];
			$this -> assign('coachName',$coachName);
            //教练价格
            $coachMap['id'] = $_GET['coach'];
			$this -> assign('coachId',$_GET['coach']);//用于下一步支付后处理操作
			$coachMap2['teacherId'] = $_GET['coach'];
			$coachMap2['classId'] = $classId;
            $coachPrice = $teacher_class -> field('coachPrice') -> where($coachMap2) -> find();
			$coachPrice = $coachPrice['coachprice']; 
			$this -> assign('coachprice',$coachPrice);
			//总额
			$sum = $coachPrice + $classInfo[0]['classprice'];
			$this -> assign('sum',$sum);
			
		}
		
		//只先班级，不选教练
		if($confirm == null && $_GET['coach'] == null)
		{
			//获取班级的名称  ,  班级价格
			$classInfo = $class -> field("id,className,classPrice,classPic,avePeriod") -> where("id=".$classId) -> select();  //班级id可能要用到
			$this -> assign('classInfo',$classInfo);
			//总额
			$sum =  $classInfo[0]['classprice'];
			$this -> assign('sum',$sum);
			
		}
		
	    //该学员已经选择过该班级,则为选择教练
	    else
		{
			//教练名字
            $coachName = $teacher -> field('tName') -> where('id='.$coachId) -> select();
			$coachName = $coachName[0]['tname'];
			$this -> assign('coachName',$coachName);            
			//教练价格
            $coachMap['id'] = $_GET['coach'];
//			$coachId = $teacher -> field('id') -> where($coachMap) ->find();
			$this -> assign('coachId',$_GET['coach']);//用于下一步支付后处理操作
			$coachMap2['teacherId'] = $_GET['coach'];
            $coachPrice = $teacher_class -> field('coachPrice') -> where($coachMap2) -> find();
			$coachPrice = $coachPrice['coachprice']; 
			$this -> assign('coachprice',$coachPrice);
			$coachface = $teacher -> field('face') -> where($coachMap) ->find();
			$this -> assign('coachface',$coachface);
			//总额
			$sum = $coachPrice + $classInfo[0]['classprice'];
			$this -> assign('sum',$sum);
		}
		
		$this -> display();
		
		
	}
////////////////////////////////////////////////////////////////////////////
//  /*
//	 *支付后处理(正常流程)
//	 */
//	 public function payDeal()
//	 {
//	 	//没有登录
//		if($_SESSION['identity'] == null)
//		{
//          $this->error('请先登录', U('Home/Index/index'),3);
//		}
//		//老师登录
//		if($_SESSION['identity'] == "teacher")
//		{
//          $this->error('身份不符', U('Home/Index/index'),3);
//		}
//		
//		//学生登录
//		else
//		{
//		$stu_class = M('stu_class');
//		$student = M('student');
//		$teacher = M('teacher');
//		$class = M('class');
//		$teacher_class = M('teacher_class');
//		$chatroom = M('chatroom');
//		$orders = M('orders');
//		$model = new Model();
//		
//		//获取学生id
//		$where['stuName'] = $_SESSION['name'];
//		$where2['phone'] = $_SESSION['name'];
//		//用户名登录的
//		$studentInfo = $student -> field('id,stuName,account') ->where($where) ->select();
//		//手机登录的
//		if(!$studentInfo)
//		{
//		$studentInfo = $student -> field('id,stuName,account') ->where($where2) ->select();
//		}
//		$studentId = (int)($studentInfo[0]['id']);
//		
//		
//		
//		//检测该学员是否有未毕业的班级
//		$map['stuId'] = $studentId;
//		$map['graduateStatus'] = 0;
//		$ifExistUngraduatedClass = $stu_class -> where($map) -> find();
//		if($ifExistUngraduatedClass)
//		{
//			$this -> error("您有未毕业的班级，选择失败");
//		}
//		
//		
//		//再一次检测该学员是否已经选择该班级
//		$data['stuId'] = $studentId;
//		$data['classId'] = (int)($_GET['classId']);
//		$confirm = $stu_class -> where($data) ->find(); 
//		//该学员没有选择过该班级
//		if($confirm)
//		{
//			$this -> error("您已经选择了该班级");
//		}
//		
//		//开户事务
//		$model      ->  startTrans();  //扣费事务
//		$stu_class  ->  startTrans();  //增加学生的班级事务
//		$chatroom   ->  startTrans();  //聊天表增加数据事务
//      $orders     -> 	startTrans();  //订单表增加数据事务
//		
//		//班级收费
//		$classId = (int)($_GET['classId']);
//		$classAcount =  $class -> field("classPrice") -> where("id=".$classId) -> select(); 
//		$classAcount = (int)($classAcount[0]['classprice']);
//		 //教练收费
//		$coachMap['teacherId'] = (int)($_GET['coachId']);
//		$coachMap['classId'] =  (int)($_GET['classId']);
//		$coachAcount = $teacher_class -> field('coachPrice') -> where($coachMap) ->select();
//		$coachAcount = (int)$coachAcount[0]['coachprice'];
//		//总额
//		$sum = $classAcount + $coachAcount;
//      //学生余额判断
//      $currentAccount = (int)($studentInfo[0]['account']) - $sum;
//      if($currentAccount < 0)
//		{
//			$this -> error("账户余额不足");
//		}
//       
//		$payResult = $model -> execute("update student set account = $currentAccount where id = $studentId");
//		
//		//扣费成功
//		if($payResult)
//		{
//		//stu_class插入的数据
//		$data['stuId'] = $studentId;
//		$data['classId'] = (int)($_GET['classId']);
//		$data['teacherId'] = (int)($_GET['coachId']);
//		$data['time'] = date("Y-m-d"); 
//		$result = $stu_class -> data($data) -> add();
//			
//		//聊天表增加数据
//		$chatData['stuName'] = $_SESSION['name'];
//		$chatData['roomId'] = (int)($_GET['coachId']);
//		$chatresult = $chatroom -> data($chatData) -> add();
//		
//		//订单表增加数据
//		$time = Date("Y-m-d H:i:s");
//		$orderData['no'] = strtotime($time) .$studentId.rand(0,9);
//		$orderData['time'] = $time;
//		$orderData['stuId'] = $studentId;
//		$orderData['classId'] = (int)($_GET['classId']);
//		$orderData['teacherId'] = (int)($_GET['coachId']);
//		$orderData['classPrice'] = $classAcount;
//		$orderData['teacherPrice'] = $coachAcount;
//		
//		$orderresult = $orders -> data($orderData) -> add();
//		
//		
//		}
//		
//		//增加操作成功
//		if( $result > 0 && $chatresult > 0 && $orderresult > 0)
//		{
//			$model     ->  commit();
//			$stu_class ->  commit();
//			$chatroom  ->  commit();
//		    $orders    ->  commit();
//			$this->success('选择成功', U('Home/Student/student'),3);
//		}
//		//增加操作失败
//	    else
//	    {
//	       $model     ->  rollback();
//		   $stu_class ->  rollback();
//		   $chatroom  ->  rollback();
//		   $orders    ->  rollback();
//	       $this->error('选择失败', U('Home/Index/Index'),3);
//	    }
//        
//		}
//	 }
	 
/////////////////////////////////////////////////////////////////////////	 
	 
	  /*
	   * 支付后处理(只选择班级,不选教练)
	   */
	   public function skipCoach()
	   {
	   	//没有登录
		if($_SESSION['identity'] == null)
		{
            $this->error('请先登录', U('Home/Index/index'),3);
		}
		//老师登录
		if($_SESSION['identity'] == "teacher")
		{
            $this->error('身份不符', U('Home/Index/index'),3);
		}
		//学生登录
		else
		{
		$class     =  M('class');
		$stu_class =  M('stu_class');
		$student   =  M('student');
		$teacher   =  M('teacher');
		$orders    =  M('orders');
		$model1    =  new Model();
		$model2    =  new Model();
		
		
		//开户事务
		$model1     ->  startTrans();  //学生扣费事务
		$model2     ->  startTrans();  //管理员增加余额事务
		$stu_class  ->  startTrans();  //增加学生班级事务
		$orders     ->  startTrans();  //订单表增加数据事务
		$teacher    ->  startTrans();  //增加教练冻结资金事务
		
		//获取学生id
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		//用户名登录的
		$studentId = $student -> field('id,stuName,account') ->where($where) ->select();
		//手机登录的
		if(!$studentId)
		{
		$studentId = $student -> field('id,stuName,account') ->where($where2) ->select();
		}
		$map['stuId'] = (int)($studentId[0]['id']);
		$map['graduateStatus'] = 0;
		$ifExistUngraduatedClass = $stu_class -> where($map) -> find();
		if($ifExistUngraduatedClass)
		{
			$this -> error("您有未毕业的班级，选择失败");
		}
		//插入的数据
		$data['stuId'] = (int)($studentId[0]['id']);
		$data['classId'] = (int)($_GET['classId']);
		//检测该学员是否已经选择该班级
		$confirm = $stu_class -> where($data) ->find(); 
		//该学员没有选择过该班级
		if($confirm == null)
		{
			//班级收费
			$classId = (int)($_GET['classId']);
			$classAcount =  $class -> field("classPrice") -> where("id=".$classId) -> select(); 
			$classAcount = (int)($classAcount[0]['classprice']);
			//总额
		    $sum = $classAcount;
             //学生余额判断
            $currentAccount = (int)($studentId[0]['account']) - $sum;
            if($currentAccount < 0)
		    {
		    	$this -> error("账户余额不足");
		    }
            $stuId = (int)($studentId[0]['id']);
		    $payResult = $model1 -> execute("update student set account = $currentAccount where id = $stuId");
			//扣费成功
			if($payResult)
			{
			//stu_class插入的数据
			$data2['stuId'] = $stuId;
			$data2['classId'] = (int)($_GET['classId']);
			$data2['time'] = date("Y-m-d"); 
			$result = $stu_class -> data($data) -> add();
			
			//订单表增加数据
			$time = Date("Y-m-d H:i:s");
			$orderData['no'] = strtotime($time) .$stuId.rand(0,9);
			$orderData['time'] = $time;
			$orderData['stuId'] = $stuId;
			$orderData['classId'] = (int)($_GET['classId']);
			$orderData['teacherId'] = null;
			$orderData['classPrice'] = $classAcount;
			$orderData['teacherPrice'] = null;
			
			$orderresult = $orders -> data($orderData) -> add();
			
			//管理员增加余额
			$adminAddAccoundResult = $model2 -> execute("UPDATE `admin` SET `account` = `account`+$classAcount WHERE `admin`.`adminName` = 'admin'");
			
			}
		
			//增加操作成功
			if( $result > 0  && $orderresult > 0 && $adminAddAccoundResult > 0)
			{
				$model1     ->  commit();
				$model2     ->  commit();
				$stu_class  ->  commit();
			    $orders     ->  commit();
				$this->success('选择成功', U('Home/Student/student'),3);
			}
			//增加操作失败
		    else
		    {
		       $model1     ->  rollback();
		       $model2     ->  rollback();
			   $stu_class  ->  rollback();
			   $orders     ->  rollback();
		       $this->error('选择失败', U('Home/Index/Index'),3);
		    }
	          
			}
		    //该学员已经选择过该班级
		    else
			{
				$this->error('您已经选择了该班级，不可重复选择', U('Home/Student/student'),3);		
			}
		}
	    }
	    
	/*
	 *支付后处理(只选择教练)
	 */
	 public function payCoachFare()
	 {
	 	//没有登录
		if($_SESSION['identity'] == null)
		{
            $this->error('请先登录', U('Home/Index/index'),3);
		}
		//老师登录
		if($_SESSION['identity'] == "teacher")
		{
            $this->error('身份不符', U('Home/Index/index'),3);
		}
		
		//学生登录
		else
		{
		$stu_class = M('stu_class');
		$student = M('student');
		$teacher = M('teacher');
		$class = M('class');
		$teacher_class = M('teacher_class');
		$chatroom = M('chatroom');
		$orders = M('orders');
		$model1 = new Model();
		$model2 = new Model();
		
		//开户事务
		$model1    ->  startTrans();  //学员扣教练费用同时冻结相应的资金事务,减少account,增加frozenFunds
		$model2    ->  startTrans();  //stu_class插入的数据事务
		$chatroom  ->  startTrans();  //聊天表增加数据事务
		$orders    ->  startTrans();  //订单表增加数据事务
		
		//获取学生id
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		//用户名登录的
		$studentInfo = $student -> field('id,stuName,account') ->where($where) ->select();
		//手机登录的
		if(!$studentInfo)
		{
		$studentInfo = $student -> field('id,stuName,account') ->where($where2) ->select();
		}
		$studentId = (int)($studentInfo[0]['id']);
		
		//再一次检测该学员是否已经选择该班级
		$data['stuId'] = $studentId;
		$data['classId'] = (int)($_GET['classId']);
		$confirm = $stu_class -> where($data) ->find(); 
		//该学员没有选择过该班级
		if($confirm['teacherid'] != null)
		{
			$this -> error("您已经选择有教练");
		}
		if($confirm['graduatedstatus'] != 0)
		{
			$this -> error("您已经在此班级毕业啦");
		}
		
		//教练收费
		$coachMap['teacherId'] = (int)($_GET['coachId']);
		$coachMap['classId'] =  (int)($_GET['classId']);
		$coachAcount = $teacher_class -> field('coachPrice') -> where($coachMap) ->select();
		$coachAcount = (int)$coachAcount[0]['coachprice'];
		//总额
		$sum = $coachAcount;
		
        //学生余额判断
        $currentAccount = (int)($studentInfo[0]['account']) - $sum;
        
        if($currentAccount < 0)
		{
			$this -> error("账户余额不足");
		}
		$payResult = $model1 -> execute("update student set account = $currentAccount,`frozenFunds` = `frozenFunds`+$coachAcount where id = $studentId");
		//扣费成功
		if($payResult)
		{
		//stu_class插入的数据
		$stuId = $studentId;
		$classId = (int)($_GET['classId']);
		$teacherId = (int)($_GET['coachId']);
		$result = $model2 -> execute("UPDATE `stu_class` SET `teacherId` = $teacherId WHERE stuId=$stuId and classId=$classId");
		
		//聊天表增加数据
		$chatData['stuName'] = $_SESSION['name'];
		$chatData['roomId'] = (int)($_GET['coachId']);
		$chatresult = $chatroom -> data($chatData) -> add();
		}
		
		//订单表增加数据
		$time = Date("Y-m-d H:i:s");
		$orderData['no'] = strtotime($time) .$studentId.rand(0,9);
		$orderData['time'] = $time;
		$orderData['stuId'] = $studentId;
		$orderData['classId'] = (int)($_GET['classId']);
		$orderData['teacherId'] = (int)($_GET['coachId']);
		$orderData['classPrice'] = null;
		$orderData['teacherPrice'] = $coachAcount;
		
		$orderresult = $orders -> data($orderData) -> add();
		
		//增加操作成功
		if( $result > 0 && $chatresult > 0 && $orderresult > 0)
		{
			$model1    -> commit();
			$model2    -> commit();
			$chatroom  -> commit();
		    $orders    ->  commit();
			$this->success('选择成功', U('Home/Student/student'),1);
		}
		//增加操作失败
	    else
	    {
	    	$model1    ->  rollback();
			$model2    ->  rollback();
			$chatroom  ->  rollback();
		    $orders    ->  rollback();
	        $this->error('选择失败', U('Home/Index/Index'),3);
	    }
          
		}
	 }
	 
	/*
	 * 班级费用为0，立即参加
	 */
	public function freePay()
	{
		$stu_class = M('stu_class');
		$orders = M('orders');
		
		//开户事务
		$orders       ->  startTrans();  //订单表增加数据事务
		$stu_class    ->  startTrans();  //订单表增加数据事务
		
        $stuId = $_SESSION['stuId'];
        
        //检测该学员是否已经选择该班级
		$data1['stuId'] = $stuId;
		$data1['classId'] = (int)($_GET['classId']);
		$confirm = $stu_class -> where($data1) ->find(); 
		 //该学员没有选择过该班级
		if($confirm['teacherid'] != null)
		{
			$this -> error("您已经选择有教练");
		}
		if($confirm['graduatedstatus'] != 0)
		{
			$this -> error("您已经在此班级毕业啦");
		}
		
		//检测是否有未毕业的班级
		$map['stuId'] = $stuId;
		$map['graduateStatus'] = 0;
		$ifExistUngraduatedClass = $stu_class -> where($map) -> find();
		if($ifExistUngraduatedClass)
		{
			$this -> error("您有未毕业的班级，选择失败");
		}
		
        //stu_class插入的数据
		$data['stuId'] = $stuId;
		$data['classId'] = (int)($_GET['id']);
		$data['time'] = date("Y-m-d"); 
		try{
		  $result = $stu_class -> data($data) -> add();
		}catch(\Exception $e)
		{
			$this -> error("选择异常");
		}
		
		//订单表增加数据
		$time = Date("Y-m-d H:i:s");
		$orderData['no'] = strtotime($time) .$stuId.rand(0,9);
		$orderData['time'] = $time;
		$orderData['stuId'] = $stuId;
		$orderData['classId'] = (int)($_GET['id']);
		$orderData['teacherId'] = null;
		$orderData['classPrice'] = 0;
		$orderData['teacherPrice'] = null;
		try{
		 $orderresult = $orders -> data($orderData) -> add();
		}catch(\Exception $e)
		{
			$this -> error("选择异常");
		}
	
		//增加操作成功
		if( $result > 0  && $orderresult > 0)
		{
			$stu_class  ->  commit();
		    $orders     ->  commit();
			$this->success('选择成功', U('Home/Student/student'),3);
		}
		//增加操作失败
	    else
	    {
		   $stu_class  ->  rollback();
		   $orders     ->  rollback();
	       $this->error('选择失败', U('Home/Index/Index'),3);
	    }
	}


   /*
    * 生成二维码，具体内容待定
    */
    public function qrcode($url = 'http://120.76.250.229/jiaolianyuan/Home/Index/index.html', $level = 3, $size = 4) 
    {
		Vendor('phpqrcode.phpqrcode');
		$errorCorrectionLevel = intval($level);
		//容错级别
		$matrixPointSize = intval($size);
		//生成图片大小
		//生成二维码图片
		//echo $_SERVER['REQUEST_URI'];
		$object = new \QRcode();
		$object -> png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
	}	

}