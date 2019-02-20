<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class StudentController extends StudentcommonController {
    public function student(){
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
	    //梦杰修改
		$student = M('student');
//			$map['phone'] = $_SESSION['phone'];


        $map['phone'] = $_SESSION['phone'];
		
		
        $c_name = $student ->where($map) ->select();
//			var_dump($c_name);
		$stuName = $c_name[0]['stuname'];
		$this->assign('stuName',$stuName);
		//修改结尾
	    $studentBasicInfo = $this -> getstudentBasicInfo();
		$this->assign('studentBasicInfo',$studentBasicInfo);
	
//	    $coachesList = $this -> getTeacherList();
//		$this->assign('coachesList',$coachesList);
	
	    $getClassList = $this -> getClassList();
		$this->assign('getClassList',$getClassList);
	 
	    $this -> page();
	
	
	     //消息   +++++
	 	$messageData = $this -> allTitle();
		$this -> assign('messageData',$messageData);
	
	    // 未读消息个数++++
	    $unReadMsgNum = $this -> unReadMsgNum();
	    $this -> assign('unReadMsgNum',$unReadMsgNum);
	
	    $this -> display();
		
	}
	
	
	/*
	 * 获取学生基本信息，用户名不能重复
	 */
	public function getstudentBasicInfo()
	{
		$student = M('student');
		$where['id'] = $_SESSION['stuId'];
		$studentData = $student -> field('id,school,account,stuName,tIntro') ->where($where) ->select();
		return $studentData;
	}
	
	/*
	 * 获取学生选的教练信息，用户名不能重复
	 */
	/*public function getTeacherList()
	{
		$model = new Model();
		$student = M('student');
		$teacher = M('teacher');
		$studentId = (int)($_SESSION['stuId']);
		//获取学生选的教练信息
		$coaches = $model -> query("select id,tname,face,onlineTime from teacher where id in (select teacherId from `stu_class` where stuId = $studentId)");
		return $coaches;
	}
	*/
	
	
	/*
	 * 获取学生班级列表,未毕业的排在前面    用户名不能重复
	 * 0：未毕业     1：已毕业
	 */
	public function getClassList()
	{
		$cacheIndex = $_SESSION['name'];//设置缓存下标
	 	$cache = S($cacheIndex);
		//没有缓存
	    if($cache == NULL)
		{
//		$student = M('student');
		$model = new Model();
//		$where['stuName'] = $_SESSION['name'];
//		$where2['phone'] = $_SESSION['name'];
//		//获取学生id
//		//用户名登录的
//		$studentId = $student -> field('id,stuName') ->where($where) ->select();
//		//手机登录的
//		if(!$studentId)
//		{
//		$studentId = $student -> field('id,stuName') ->where($where2) ->select();
//		}
		$studentId = (int)($_SESSION['stuId']);
		$classList = $model -> query("select class.id,className,classPic,graduateStatus from ((select classId,graduateStatus from `stu_class` where stuId=$studentId )as a left join `class` on a.classId = class.id ) order by graduateStatus asc");
		S($cacheIndex,$classList,12); //写入缓存，时间120s  
		
		return $classList;
//		dump($classList);
		}
		//有缓存
		else
	    {
		return $classList;
		}
		
	}
	
	/*
	 * 分页,学生下面的班级
	 * */
	public function page()
	{
		$cacheIndex = $_SESSION['name'];//设置缓存下标
//	 	$cache = S($cacheIndex);
		//没有缓存
//	    if($cache == NULL)
//		{
		$student = M('student');
		$model = new Model();
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		//获取学生id
		//用户名登录的
		$studentId = $student -> field('id,stuName') ->where($where) ->select();
		//手机登录的
		if(!$studentId)
		{
		$studentId = $student -> field('id,stuName') ->where($where2) ->select();
		}
		$studentId = (int)($studentId[0]['id']);
		$count = $model -> query("select count(*) from ((select classId,graduateStatus from `stu_class` where stuId=$studentId )as a left join `class` on a.classId = class.id ) order by graduateStatus asc");
//		S($cacheIndex,$classList,12); //写入缓存，时间120s  
		$count = (int)($count[0]['count(*)']);
		
		$Page       = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出
//		$list = $User->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
		$firstRow = $Page->firstRow;
		$listRows = $Page->listRows;
		$list = $model -> query("select class.id,className,classPic,graduateStatus from ((select classId,graduateStatus from `stu_class` where stuId=$studentId )as a left join `class` on a.classId = class.id ) order by graduateStatus asc limit $firstRow,$listRows");
//		dump($list);
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		
//		return $classList;
//		dump($classList);
//		}
		//有缓存
//		else
//	    {
//		return $classList;
//		}
	}
	
	
	
//	/*
//	 * 获取班级的项目,接收一个班级id
//	 */
//	public function getProjectList()
//	{
//		//接收班级id
//		$classId = 1;
//		$stuId = 1;
//		$status = 0;
//		$model = new Model();
//		
//		$data = $model -> query("select * from ((select projectId,status,startTime,declineTime from `stu_project` where stuId = $stuId and status=$status)as a left join (select * from project where id in (select projectId from `class_project` where classId = $classId )) as b on a.projectId = b.id )  ");
////		$data = $model -> query("select * from ((select * from project where id in (select projectId from `class_project` where classId = $classId )) as b left join (select projectId,status,startTime,declineTime from `stu_project` where stuId = $stuId and status=$status)as a on a.projectId = b.id )  ");
//		
//		$this ->ajaxReturn($data); 
//	}


	
/*
	 * 展示项目状态
	 */
      public function projectStatus($cid){
    	$classId = $cid ;
		$_SESSION['classId'] = $classId;
//		var_dump($classId);
    	$student = M('student');
		$model = new Model();
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		//获取学生id
		//用户名登录的
		$stuId = $student -> field('id,stuName') ->where($where) ->select();
		//手机登录的
		if(!$stuId)
		{
		$stuId = $student -> field('id,stuName') ->where($where2) ->select();
		}
		$stuId = (int)($stuId[0]['id']);
//		var_dump($stuId);
		//未完成
        //待领取
		$activationProject = $model ->query("select * from `project` where id not in (select projectId from `stu_project` where stuId =$stuId and classId=$classId ) and id in (select projectId from `class_project` where classId =$classId) order by id ");
//		return $activationProject;//待激活
		$unsubmitedProject = $model ->query("select project.id,name,requiretime,sense,request,dataUrl,status from `stu_project`,`project` where classid = $classId and stuid = $stuId and status = 2 and project.id = stu_project.projectid");
		$data['unsubmited'] = $unsubmitedProject; 
		$auditProject = $model ->query("select project.id,remark,remarktime,rank,name,requiretime,sense,request,dataUrl,status from `work`,`project` where projectid in (select projectId from `stu_project` where classId = $classId and stuId = $stuId and status = 1)and status = 0 and project.id = work.projectid and work.stuId=$stuId ");
		$data['audit'] = $auditProject; 
		$notpassProject = $model -> query("select project.id,remark,remarktime,rank,name,requiretime,sense,request,dataUrl,status from `work`,`project` where projectid in (select projectId from `stu_project` where classId = $classId and stuId = $stuId and status = 1) and status = 2 and project.id = work.projectid and work.stuId=$stuId");		
		$data['notpass'] = $notpassProject; 
		//等待领取
		if($data['unsubmited']||$data['audit']||$data['notpass']){}
        else{
			$projectid = $model ->query("select * from `project` where id not in (select projectId from `stu_project` where stuId =$stuId and classId=$classId ) and id in (select projectId from `class_project` where classId =$classId) order by id asc limit 0,1 ");
			$bactiveProject =  $model ->query ("select project.id,name,requiretime,sense,request,dataUrl,status from `stu_project`,`project` where classid = $classId and stuid = $stuId and status = 0 and project.id = stu_project.projectid") ;
	        if(!$activationProject){}else{
	        	if(!$bactiveProject)
				{
				    $data1['status'] = 0;
					$data1['stuId'] = $stuId;
					$data1['projectId'] = (int)($projectid[0]['id']);
					$data1['classId'] = (int)($classId);
				    $stu_project = M('stu_project');
					$result = $stu_project->add($data1);
					}	 
					$bactiveProject =  $model ->query ("select project.id,name,requiretime,sense,request,dataUrl,status from `stu_project`,`project` where classid = $classId and stuid = $stuId and status = 0 and project.id = stu_project.projectid") ;
					$data['bactive'] = $bactiveProject;
				}
	        }
        
		//未完成
		$activationProject = $model ->query("select * from `project` where id not in (select projectId from `stu_project` where stuId =$stuId and classId=$classId ) and id in (select projectId from `class_project` where classId =$classId) order by id asc ");
//		var_dump($activationProject);
        $data['activation'] = $activationProject;
		$doneProject = $model -> query("select project.id,remark,remarktime,rank,name,requiretime,sense,request,dataUrl,status from `work`,`project` where projectid in (select projectId from `stu_project` where classId = $classId and stuId = $stuId and status = 1) and status = 1 and project.id = work.projectid and stuId=$stuId");		
		$data['done'] = $doneProject; 
		//检测是否到时
		if($data['unsubmited'][0]['id']){
			$project = M('project');
	      	$stu_project = M('stu_project');
	      	$where['id'] = $data['unsubmited'][0]['id'];  //项目id
	      	 $id= $data['unsubmited'][0]['id'];
	      	$requireDate = $project -> field('requireTime') -> where($where) -> find();
			$requireTime = (int)($requireDate['requiretime']) * 24*60*60;   //获取项目需要的秒
	        $time = time();  //获取现在时间戳
	      	//计算已经花费的时间
	      	$startTime = $model ->query("select starttime from stu_project where projectId = $id and stuId = $stuId");
      	    $result = $time - $startTime[0]['starttime'];
	      	if($result >= $requireTime)
	      	{
	      		$data['unsubmited'][0]['overtime'] = 1;
	      	}
	      	else{
	//    		$data['value'] = "";
	//    		$over['message'] = "";
	      	}
		}
		
		
		
		return $data;
    }
	
	
	public function student2()
	{
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
		$classId = $_GET['classId'];
		
		$this->assign('classId',$classId);
		
        $this -> deleteCoach();//清除学员正在学的班级超时的教练
        
        $className = $this -> getClassName($classId);
        $this -> assign("className",$className);  //用于导航栏的班级名字显示
        
        $projectStatus = $this -> projectStatus($classId);
		$this->assign('projectStatus',$projectStatus);
		
		//返回学员在该班级的教练
		$coachesList2 = $this -> getCoach($classId);
		$this->assign('coachesList2',$coachesList2);
		
		$studentBasicInfo = $this -> getstudentBasicInfo();
		$this->assign('studentBasicInfo',$studentBasicInfo);
		
		$this -> display();
			
	}
	
	/*
	 * 获取班级名字
	 */
	public function getClassName($classId)
	{
	    $class = M('class');
	    $className = $class -> field('id,className') -> where("id=".$classId) -> find();
	    return $className['classname'];
	}
	
	
	/*
	 * 返回学员在该班级已经选择的教练，如果没有选择教练则显示可以选择的教练
	 */
	public function getCoach($classId)
	{
		$stu_class = M('stu_class');
     	$student = M('student');
     	$teacher = M('teacher');
     	$model = new Model();
     	
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		//获取学生id  
		//用户名登录的
		$stuId = $student -> field('id') ->where($where) ->select();
		//手机登录的
		if(!$stuId)
		{
		$stuId = $student -> field('id,stuName') ->where($where2) ->select();
		}
		
		
		//查询该学员在该班级是否先择了教练
		$map['stuId'] = $stuId[0]['id'];    
		$map['classId'] = $classId; 	
		$ifSelectCoach = $stu_class -> field('id,teacherId') -> where($map) -> find();
		
		//有选择教练,返回教练信息
		if($ifSelectCoach['teacherid'])
		{
			$coachInfo = $teacher -> where("id=".$ifSelectCoach['teacherid']) -> select();
            return $coachInfo;
		}
		//没有选择教练，获取班级的所有教练,可重新选择
		else
		{
			$coachListOfClass = $model -> query("select teacher.id,teacher.tName,teacher.sex,teacher.tIntro,teacher.face,teacher.onlineTime,`teacher_class`.classId,`teacher_class`.coachPrice from teacher,`teacher_class` where `teacher_class`.classId=$classId and `teacher_class`.auditStatus=1 and `teacher_class`.teacherId=teacher.id");
            return $coachListOfClass;
		}
	}
     
	/*
	 * 项目详情
	 */
	  public function projectDetail()
	 {
	    $name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
	 		
	 	$studentBasicInfo = $this -> getstudentBasicInfo();
		$this->assign('studentBasicInfo',$studentBasicInfo);
		
	 	$projectId = urldecode($_GET['projectId']);
		
		$projectInfo = $this -> getProjectInfo($projectId);
		$this->assign('projectInfo',$projectInfo);
		
		$this -> assign("classId",$_SESSION['classId']); //用于查看可选教练
		$ifSelectCoach = $this -> ifSelectCoach($_SESSION['classId']);
		$this->assign('ifSelectCoach',$ifSelectCoach);
		
		$className = $this -> getClassName($_SESSION['classId']);
        $this -> assign("className",$className);  //用于导航栏的班级名字显示
		
		//返回学员在该班级的教练
		$coachesList2 = $this -> getCoach($_SESSION['classId']);
		$this->assign('coachesList2',$coachesList2);
		//获取学生的全部教练，已弃用
//		$coachesList3 = $this -> getTeacherList();
//		$this->assign('coachesList3',$coachesList3);
		
		$proRes = $this -> getprojectResult($projectId);
		$this->assign('proRes',$proRes);
		
		$this -> display();
	 }
	 
	 /*
	  * 判断是否在该班级选择了教练
	  */
	 public function ifSelectCoach($classId)
	 {
	 	$stu_class = M('stu_class');
	 	$map['stuId'] = $_SESSION['stuId'];    
		$map['classId'] = $classId; 	
		$ifSelectCoach = $stu_class -> field('id,teacherId') -> where($map) -> find();
		//有选择教练,返回200
		if($ifSelectCoach['teacherid'])
		{
            return 200;
		}
		//没有选择教练,返回400
		else
		{
            return 400;
		}
	 }
	 
	 
	  public function getProjectInfo($projectId)
	  {
	  	//判断是否肄业
	  	$stu_class = M('stu_class');
     	$student = M('student');
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		$classId= (int)($_SESSION['classId']);
		$where['stuId'] = $_SESSION['stuId'];    
		$where['classId'] = $classId; 	
		$result = $stu_class -> field("graduateStatus") -> where($where) -> select();
	  	if($result[0]['graduatestatus'] == 2)
	  	{
	  		$this -> error("肄业后不可继续进行这个班级的项目");
	  	}
	  	
	  $project = M('project');
       try{
       	     $projectInfo = $project ->where('id='.$projectId) -> select();
          }
          catch( \Exception $e){
          	echo "出错";
          }
		 return $projectInfo;
		
	  }
	  
	  /*
	   * 获取学生作业成绩和评价
	   */
	   public function getprojectResult($projectId)
	   {
	   	$student = M('student');
		$model = new Model();
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		$classId= (int)($_SESSION['classId']);
		//获取学生id  
		//用户名登录的
		$stuId = $student -> field('id,stuName') ->where($where) ->select();

		//手机登录的
		if(!$stuId)
		{
		$stuId = $student -> field('id,stuName') ->where($where2) ->select();
		}
		$stuId = (int)($stuId[0]['id']);
//		var_dump($projectId);

		$bactivate = $model ->query("select * from stu_project where projectid = $projectId and stuid = $stuId and status = 0");
		$data['bactivate'] = $bactivate;
//		select * from `class_project` where classId=$classId and projectId not in (select projectId from `stu_project` where stuId =$stuId and classId=$classId ) 

		 
		$activation = $model ->query("select * from `project` where id not in (select projectId from `stu_project` where stuId =$stuId and classId=$classId ) and id in (select projectId from `class_project` where classId =$classId) order by id asc limit 0,1");
//		$activationProject = $stu_pro -> where($map) ->limit(0,1) ->select();select * from stu_project where projectid = $projectId and stuid = $stuId and status = 0
		$data['activation'] = $activation; 
//		$data['bactivate'] = $activation;
		$unsubmited = $model ->query("select * from stu_project where projectid = $projectId and stuid = $stuId and status = 2 ");
//		$unsubmitedProject = $stu_pro -> where($map) ->limit(0,1) ->select();
		$data['unsubmited'] = $unsubmited; 
		$audit = $model ->query("select * from work where projectid = $projectId and stuid = $stuId and status = 0");
		$data['audit'] = $audit; 
		$notpass = $model ->query("select * from work where projectid = $projectId and stuid = $stuId and status = 2");
		$data['notpass'] = $notpass; 
		$done = $model ->query("select * from work where projectid = $projectId and stuid = $stuId and status = 1");		
		$data['done'] = $done; 


        $project = M('project');
      	$stu_project = M('stu_project');
      	//获取项目需要的秒
      	$where['id'] = $projectId;  //项目id
      	$requireDate = $project -> field('requireTime') -> where($where) -> find();
		$requireTime = (int)($requireDate['requiretime']) * 24*60*60;   //获取项目需要的秒
        $time = time();  //获取现在时间戳
      	//计算已经花费的时间
      	$startTime = $model ->query("select startTime from stu_project where projectId=$projectId and stuId = $stuId");
      	$result = $time - $startTime[0]['starttime'];
      	if($startTime[0]['starttime'] !=null)
		{
      	if($result >= $requireTime)
      	{
      		$data['unsubmited'][0]['value1'] = ($result - $requireTime)/60/60;
      		$data['unsubmited'][0]['message1'] = "此项目作答时间已经超过预定时间，请尽快提交！";
      	}
      	else{
            $data['unsubmited'][0]['value2'] = ($requireTime - $result)/60/60;
      		$data['unsubmited'][0]['message2'] = "请您尽快提交！";
      	}
      	}
		return $data;
	   }	  	
	   
	   
	public function change_info(){
		
		$student = M('student');
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
			$get['phone'] = $_SESSION['phone'];
			$get = $student -> where($get) ->select();
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
        	$map['stuName'] = $_POST['name'];
			$check_name = $student ->where($map) ->select();
			if($check_name > 0){
				echo "<script>alert('该用户名已被注册');</script>";
			}else{
				$data['stuName'] = $_POST['name'];
			}
        }
		
        $data['sex'] = $_POST['sex'];
		$m['phone'] = $_SESSION['phone'];
		try{
			
          $result =	$student -> where($m) ->save($data);
		  if($result)
		  {
			$this->success("更改成功", U('Home/Student/student'),1);
		  }
       }catch(\Exception $e)
	      {
              $this->error("更改失败", U('Home/Student/student'),3);
	      }
		  
		
	}

    public function submitPro($projectid){//file没有做上传处理
		$stu_pro = M('stu_project');
		$work = M('work');
		$map['projectid'] = $projectid;
		$stuName = $_SESSION['name'];
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		$time = date("Y-m-d-H-i-s");
//		var_dump($projectid);
		$saveName = $projectid."_".$stuName."_".$time;
		$data1['status'] = 1 ;
		$data2['status'] = 0 ;
		try{
			$upload = new \Think\Upload();// 实例化上传类    
			$upload->maxSize   =     3145728 ;// 设置附件上传大小    
			$upload->exts      =     array('zip');// 设置附件上传类型    
			// $upload->rootPath  =      './Public/project/'; // 设置附件上传目录 
			$upload->savePath  =      './projects/'; // 设置附件上传目录     
			$upload->saveName  =     $saveName;
			// 上传文件     
			$info   =   $upload->upload();    
		    //文件保存的路径
		    $path = substr($info['project']['savepath'],1);//去掉前面的点.
			$filepath =  "http://120.76.250.229/jiaolianyuan/Uploads".$path.$info['project']['savename'];
		
			//下载路径 ： localhost/jiaolianyuan/Uploads/projects/2016-08-30/6_xiaopeng_2016-08-30-16-42-39.zip
		
				if(!$info) 
 			{
					// 上传错误提示错误信息      
					$this->error($upload->getError());    
				}else{
					// 上传成功  
					$work = M('work');
					$student = M('student');
					
					//获取学生id
					//用户名登录的
					$stuId = $student -> field('id,stuName') ->where($where) ->select();
					//手机登录的
					if(!$stuId)
					{
					$stuId = $student -> field('id,stuName') ->where($where2) ->select();
					}
					
					$datas['stuId'] = $stuId[0]['id'];
					$datas['projectId'] = $projectid; //先这样，以后要改
//					$datas['submitTime'] = $time;
					$datas['submitTime'] = date("Y-m-d h:i:s");
			//		$data['finishedTime'] = "";  //暂时没
					$datas['workUrl'] = $filepath;
					$datas['status'] = 0;
					$datas['classId'] = $_SESSION['classId'];
					
					$result1 = $work -> add($datas);
					$data2['status'] = 1;
					  $result2 = $stu_pro -> where($map) ->save($data2);
					  if($result1 > 0 && $result2)
					  {
						$this->success("提交成功");
					  }
			       }
		       
		    }catch(\Exception $e)
			      {
		              echo "<script>alert('异常，请重试');</script>";
		              $this->error("上传失败", U('Home/Student/projectDetail'),3);
			      } 
	      
	}	
	public function doagainPro($projectid){
		$stu_pro = M('stu_project');
		$work = M('work');
        $student = M('student');
		$model = new Model();
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		$classId= (int)($_SESSION['classId']);
		//获取学生id  
		//用户名登录的
		$stuId = $student -> field('id,stuName') ->where($where) ->select();

		//手机登录的
		if(!$stuId)
		{
		$stuId = $student -> field('id,stuName') ->where($where2) ->select();
		}
		$stuId = (int)($stuId[0]['id']);
		$map['stuid'] = $stuId;
		$map['projectid'] = $projectid;
		$data['status'] = 2 ;
		$data['startTime'] = time() ;
		try{

          $result = $stu_pro -> where($map) ->save($data);
          $result2 = $model ->execute("delete from work where projectId = $projectid");
		  var_dump($result2);
		  if($result&&$result2)
		  {
			$this->success("加油，有了基础很快就重新做一份了");
		  }
       }catch(\Exception $e)
	      {
//            echo "<script>alert('异常，请重试');</script>";
              $this->error("确认重做失败", U('Home/Student/projectDetail'),3);
	      }
	}
      public function getPro($projectid){
//		$pro = M('project');
		$stu_pro = M('stu_project');
		$student = M('student');
		$model = new Model();
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		$stuId = $student -> field('id,stuName') ->where($where) ->select();
		//手机登录的
		if(!$stuId)
		{
		$stuId = $student -> field('id,stuName') ->where($where2) ->select();
		}
		$stuId = (int)($stuId[0]['id']);
		$map['stuId'] = $stuId;
		$map['projectId'] = $projectid;
		
//		$requireTime = (int)($requireDate['requiretime']) * 24*60*60;   //获取项目需要的秒
//    	//    	$time = time();  //获取现在时间戳
//    	//获取领项目时的时间戳
//    	$where['stuId'] = 1;
//    	$startTime = $stu_project -> field('startTime') -> where($where) -> find();
//    	$startTime = strtotime($startTime['starttime']);  
//    	
//    	//获取现在时间戳
//    	$time = time();  //获取现在时间戳
//    	

		
	    $data1['startTime'] = time();
		$data1['status'] = 2 ;
		try{	
	          $result1 = $stu_pro -> where($map) ->save($data1);
			  if($result1)
			  {
				$this->success("申请项目成功");
			  }
          }
      catch(\Exception $e)
      {
          echo "<script>alert('异常，请重试');</script>";
          $this->error("申请项目失败", U('Home/Student/projectDetail'),3);
      } 
	}
	
	
	/*
	 * 肄业
	 */
    public function pauseStudy()
	{
		$student = M('student');
		$where['stuName'] = $_SESSION['name'];
		$where2['phone'] = $_SESSION['name'];
		$stuId = $student -> field('id,stuName') ->where($where) ->select();
		//手机登录的
		if(!$stuId)
		{
		$stuId = $student -> field('id,stuName') ->where($where2) ->select();
		}
		$where['stuId'] = (int)($stuId[0]['id']);
		$where['classId'] = $_GET['classId'];
		$data['graduateStatus'] = 2;
		$stu_class = M('stuClass');
		$result = $stu_class -> field('graduateStatus') -> where($where) -> save($data);
		if($result > 0)
		{
			$this -> success("操作成功");
		}
		else
		{
			$this -> error("操作失败");
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
	 * 学员发消息给管理员
	 * 
	 * 学生发送消息      注意：发该消息的id要传给模板
	 * senderType,targetType  :   0后台  1教练  2学生 
	 * @param String content
	 */
	 /* public function stuSendMsg()
	  {
		$message = M('message');
		$data['senderName'] = $_SESSION['name'];    //测试先为get
		$data['senderType'] = 2;
		$data['targetName'] = "admin";
		$data['targetType'] = "0";
		$data['content'] = I("post.content");
		$data['time'] = date('Y-m-d H:i:s');
		$data['isRead'] = 0;
        
		$result = $message->add($data); // 写入基本数据到数据库
        $this->success('发送成功');
	  }
*/
	  
    /*
	 * 回复管理员
	 */
	/* public function replay()
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
    */  
       
     /*
      * 学生订单中心
      */
     public function order()
     {
     	$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
		
		$studentBasicInfo = $this -> getstudentBasicInfo();
		$this->assign('studentBasicInfo',$studentBasicInfo);
		
		$orderList = $this -> orderList();
		$this -> assign("orderList",$orderList);
		
		$this -> display();
     }
     
     /*
      * 获取订单列表
      */
     public function orderList()
     {
     	$orders = M('orders');
     	$model = new Model();
        $stuId = $_SESSION['stuId'];
        try{
        $orderList = $model -> query("select * from (select orders.*,class.className,class.classPic from orders,class where orders.stuId = $stuId and orders.classId = class.id) as a left join teacher on a.teacherId=teacher.id");
     	}catch(\Exception $e)
     	{
     		$this -> error("您尚无订单");
     	}
     	return $orderList;
     }

     /*
 * 个人中心
 */
 public function personal(){
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
	    //梦杰修改
		$student = M('student');
//			$map['phone'] = $_SESSION['phone'];


        $map['phone'] = $_SESSION['phone'];
		
		
        $c_name = $student ->where($map) ->select();
//			var_dump($c_name);
		$stuName = $c_name[0]['stuname'];
		$this->assign('stuName',$stuName);
		//修改结尾
	    $studentBasicInfo = $this -> getstudentBasicInfo();
		$this->assign('studentBasicInfo',$studentBasicInfo);
	
	    //获取学生的全部教练，已弃用
//	    $coachesList = $this -> getTeacherList();
//		$this->assign('coachesList',$coachesList);
	
//	    $getClassList = $this -> getClassList();
//		$this->assign('getClassList',$getClassList);
	 
//	    $this -> page();
	
	
	     //消息   +++++
	 	$messageData = $this -> allTitle();
		$this -> assign('messageData',$messageData);
	
	    // 未读消息个数++++
	    $unReadMsgNum = $this -> unReadMsgNum();
	    $this -> assign('unReadMsgNum',$unReadMsgNum);
	
	    $this -> display();
		
	}
	
	/*
    * 教练过期后去掉
    */
	public function deleteCoach()
	{
		 
	   $class = M('class');
	   $stu_class = M('stu_class');
	   $model = new Model();
	   $stuId = $_SESSION['stuId'];
       //获取学员在未毕业班级选教练的时间及班级id,stu_class的id,学员id
       $info = $model -> query("select id,stuId,classId,teacherId,startTTime from stu_class where stuId = $stuId and graduateStatus = 0");
       //如果有选教练
       if($info[0]['teacherid'])
       {
         $classId = $info[0]['classid'];
         $id = $info[0]['id'];  //stu_class的id
         $stuId = $info[0]['stuid'];
         $teacherId = $info[0]['teacherid'];
         $avePeriod = $model -> query("select avePeriod from class where id = $classId");  //班级平均同期  天
         $avePeriod = (int)($avePeriod[0]['aveperiod']*24*60*60);   //班级平均同期  秒
         $startTTime = (int)(strtotime($info[0]['startttime'])); //选择教练时的时间
       	 $nowTime = (int)(time());  //现在时间
       	 $temTime = $nowTime - $startTTime;  //时间差
       	 if($temTime > $avePeriod)
       	 {
       	 	try{
       	 		 $model -> execute("UPDATE `stu_class` SET `teacherId` = NULL WHERE `stu_class`.`id` = $id");  //在stu_class中把该学员在该班级的教练id设为null
	       	 	 //修改chatroom
	       	 	 $stuInfo = $model -> query("select stuName,phone from student where id = $stuId");
	       	 	 $stuName = $stuInfo[0]['stuname'];
	       	 	 $phone = $stuInfo[0]['phone'];
	       	 	 $model -> execute("DELETE FROM `chatroom`  WHERE roomId = $teacherId and stuName = '$stuName'");  //在stu_class中把该学员在该班级的教练id设为null
       	 	}
       	 	catch(\Exception $e){
       	 		
       	 	}
       	 	
       	 }

       }
	}
    
	/*
	 * 帐号设置页面
	 */
	 public function setting()
	 {
	 	$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
		
		$studentBasicInfo = $this -> getstudentBasicInfo();
		$this->assign('studentBasicInfo',$studentBasicInfo);
		
		$this -> display();
	 }

}