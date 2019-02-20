<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class DetailController extends Controller {
    public function detail(){
    	
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
		
		$classBasicInfo = $this -> getBasicInfo();
		$this -> assign('classBasicInfo', $classBasicInfo);
		
		$ifSelect = $this -> ifSelect();
		$this -> assign('ifSelect', $ifSelect);
		
		
		$ProjectInfo = $this -> getProjectInfo();
		$this -> assign('ProjectInfo', $ProjectInfo);
		//弹出框的数据
		$ProjectInfo2 = $ProjectInfo;
		$this -> assign('ProjectInfo2', $ProjectInfo2);
		
		
		//第一个框
		$contentData = $this -> getComment();
		$this -> assign('contentData', $contentData);
		//第二个框
		$studentData2 = $this -> getComment2();
		$this -> assign('studentData2', $studentData2);
		
		
        $this -> display();
		
	}
	
	/*
	 * 获取班级的基本信息 : 班级详情图  班级名  平均同期  价格  班级简介
	 */
	 public function getBasicInfo()
	 {
	 	$class = M("class");
		$classId = urldecode($_GET['id']); 
		$classId = (int)($classId);
		$where['id'] = $classId;
		$classBasicInfo = $class -> field('id,className,classPrice,avePeriod,classIntro,classPic') -> where($where) -> select();
		//班级存在
		if($classBasicInfo) 
		{
		 return $classBasicInfo;
		}
		//班级不存在,防止通过url随便输入
		else
		{
			$this -> error("班级不存在");
		}
	 }
	 
	 /*
	  * 获取班级的项目信息
	  */
	  public function getProjectInfo()
	  {
	  	$model = new Model();
	  	$class = M("class");
		$class_project = M('class_project');
		$project = M('project');
		
		$classId = urldecode($_GET['id']); 
		$classId = (int)($classId);
		$where['classId'] = $classId;
		
		//在class_project中找出该班级所对应项目的ID
		$projectId = $class_project -> field('projectId') -> where($where) ->select();
		//在project中查找出项目名称   ---先找出全部东西先
//		$map['id'] = array ('in',$projectId);
//		$projectData = $project -> where($map) -> select();

       try{
            $projectData = $model -> query("select * from project where id in (select projectId from `class_project` where classId=$classId)");
          }catch(Exception $e){
          }
		 return $projectData;
//		$this -> ajaxReturn($projectData);
		
	  }
	  
	  
	  /*
	  * 获取班级的评论信息(第一个框的),因为要做成滚动的效果，所以先不限制查找的个数
	  */
	  public function getComment()
	  {
	  	$model = new Model();
	  	$classId = urldecode($_GET['id']); 
		$classId = (int)($classId);
	  	$data = $model -> query("select a.stuId,face,stuName,time,content,star from ((select stuId,classId,content,star,time from `stu_class` where content is not null and classId=$classId)as a left join student on a.stuId=student.id)");
		return $data;
	  }
	  
	  
       /*
	    * 第二个框的头像以及姓名显示
	    */
	  public function getComment2()
	  {
	  	$model = new Model();
	  	$classId = urldecode($_GET['id']); 
		$classId = (int)($classId);
		$where['classId'] = $classId;
		//获取第二个框的 头像 名字 
        $studentData = $model -> query("select id,stuName,face from student where id in (select stuId from `stu_class` where classId=$classId)");
	  	return $studentData;
	  }

       /*
	    * 选教练
	    * @param int classId
	    */
	  public function selectCoach()
	  {
	  	//点立即参加，但没登录，先登录
		if($_SESSION['identity'] == null)
		{
//		    echo "<script>alert('请先登录');</script>";
            $this->error('请先登录', U('Home/Login/login'),3);
		}
	  	$classId = urldecode($_GET['id']);
		$where['id'] = (int)($classId);
		$class = M('class');
		$className = $class -> field('className,id') -> where($where) -> select();
		$this -> assign('className',$className);
		
		//获取session数据
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
		
	  	$coaches = $this -> coaches();
		$this -> assign('coaches',$coaches);
		
	  	$this -> display();
	  }
	  
	   public function coaches()
	   {
	   	$classId = urldecode($_GET['id']);
		$classId = (int)($classId);
	  	$model = new Model();
		$coaches = $model -> query("select teacher.*,`teacher_class`.coachPrice from teacher,`teacher_class` where classId=$classId and teacher.id =`teacher_class`.teacherId and `teacher_class`.auditStatus =1");
		return $coaches;
	   }
	   
	   
	   /*
	    * 判断学员是否选择了该班级
	    */
	   public function ifSelect()
	   {
	   	$stu_class = M('stu_class');
	   	$student = M('student');
	   	$where['stuId'] = $_SESSION['stuId'];
	   	$where['classId'] = urldecode($_GET['id']); 
	    $result = $stu_class -> where($where) -> find();
	    //学员已经选择该班级
	    if($result != null)
	    {
	    	return 200;
	    }
	    else{
	    	return 400;
	    }
	    
	   }
	   
	   /*
	    * 教练详情页面
	    */
	   public function coachDetail()
	   {
	   	$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
		
		$coachInfo = $this -> getCoachInfo();
		$this -> assign("coachInfo",$coachInfo);
		
	   	$this -> display();
	   }
	   
	   /*
	    * 获取教练信息
	    */
	   public function getCoachInfo()
	   {
	   	$teacher = M('teacher');
	   	$where['id'] = $_GET['id'];
	   	$data = $teacher -> where($where) -> select();
	   	return $data;
	   }
	 
}