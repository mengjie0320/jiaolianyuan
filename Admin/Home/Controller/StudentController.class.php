<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends CommonController {

	public function index(){
		$student   = M('student'); // 实例化User对象

		

		//数据库查询使用了左外连接，首先输出个人信息，然后从stu_project表中查找学生有没有“当前正在进行的项目”，如有，则将该项目名称、该项目对应班级名称、项目剩余时间查询出来。如果没有，则使用IFNULL()对上述三项赋默认值“无”，以在前台准确展示该学生目前学习情况
       
        //$result = $student->join("stu_project ON student.id = stu_project.stuId and status = 0", "LEFT")->join("class ON stu_project.classId = class.id", "LEFT")->join("project ON stu_project.projectId = project.id", "LEFT")->field("student.id, student.stuNo, student.stuName, student.school, student.phone, IFNULL(class.className, '无') as className, IFNULL(project.name, '无') as projectName, IFNULL(stu_project.declineTime, 0) as declineTime")->select();

		$count   = $student->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $student->order('id')->limit($Page->firstRow.','.$Page->listRows)->join("stu_project ON student.id = stu_project.stuId and status = 0", "LEFT")->join("class ON stu_project.classId = class.id", "LEFT")->join("project ON stu_project.projectId = project.id", "LEFT")->field("student.id, student.stuNo, student.stuName, student.school, student.phone, IFNULL(class.className, '无') as className, IFNULL(project.name, '无') as projectName, IFNULL(stu_project.declineTime, 0) as declineTime")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }

	public function detail(){
		$Model = new \Think\Model();

		$id = I("get.id");

		//之所以将同一名学生的信息显示分成不同的sql语句处理，是因为它们在页面中展示时的格式不同
		$sql1 = "select stuNo, stuName, sex, school, phone, regTime from student where id = ".$id;
		$sql2 = "SELECT c.className, d.tName FROM student AS a LEFT JOIN stu_class AS b ON a.id = b.stuId LEFT JOIN class AS c ON b.classId = c.id LEFT JOIN teacher AS d ON b.teacherId = d.id where a.id = ".$id;
		$sql3 = "SELECT c.name as projectName, b.startTime, d.className, b.status, b.declineTime FROM student AS a LEFT JOIN stu_project AS b ON a.id = b.stuId LEFT JOIN project AS c ON b.projectId = c.id LEFT JOIN class AS d ON b.classId = d.id where a.id = ".$id." order by starttime";

		$result_1 = $Model->query($sql1);
		$result_2 = $Model->query($sql2);
		$result_3 = $Model->query($sql3);

		$this->assign("list_1", $result_1);
		$this->assign("list_2", $result_2);
		$this->assign("list_3", $result_3);

		$this->display();
	}

	public function prepare($mode){  //进入添加界面或编辑界面之前提供分类列表和项目列表的函数
		$Model = new \Think\Model();

		if($mode == 'update'){
			$sql = "select id, stuNo, stuName, sex, school, phone, regTime from student where id = ".I("get.id");
			
			$this->assign("student", $Model->query($sql));
			$this->display('updateStudent');
		}
		else{
			$this->display('addStudent');
		}
	}

	// public function add(){
        // $student = M("student");
		// //$username='xiaopeng';
		// //$sql1 = "select * from student where stuName="$username"";
		// //$name = $student->query($sql1);
		// //dump($name);
		// // header("Content-Type: text/xml;charset=utf-8");
			// // if($username == $name){
				// // echo "用户名已存在";//这里数据是返回给请求的页面.
			// // }else{
				// // echo "用户名可用";

			// // }
		

		
		  // if($student->create()){
			  // $student->add(); // 写入数据到数据库 
		  // }
		  // $this->success('添加成功！','index');
    // }

	public function update(){
        $student = M("student");
		
		$id = I("post.id");
		$username=$_GET['username'];
		$sql1 = "select stuNo, stuName, sex, school, phone, regTime from student where id = ".$id;
		$name = $student->query($sql1);
		//dump($name);
		//header("Content-Type: text/xml;charset=utf-8");
			if($username == $name){
				echo "用户名已存在";//这里数据是返回给请求的页面.
			}else{
				echo "用户名可用";

			}
		
		if($student->create()){
			$student->save(); // 修改数据到数据库 
		}
		$this->success('修改成功！','index');
    }

	public function delete(){
        $student = M("student");
		$student->delete(I("get.deleteID"));
		$this->success('删除成功！','index');
    }
	public function checkName() {
	 $a = $_POST['stuNo'];
	 $b = $_POST['stuName'];
	 $c = $_POST['password'];
	 $d = $_POST['school'];
	 $e = $_POST['phone'];
	 $f = $_POST['regTime'];
	 //echo $a;
        $user = D ('student');
        $res  = $user->where(array('stuNo'=>$_REQUEST['stuNo']))->find();
		if($a == ""){
			echo "不能为空！";
		}
		else if($res){
			echo "用户已存在！";
		}else{
			echo "可注册！";
		}
    }
	
	public function add() {
        $user = D ( 'student' );
        if (! $user->create ()) {
            dump ( $user->getError () );
        }
        $uid = $user->add ();
         
        $this->success('添加成功！','index');
    }
}