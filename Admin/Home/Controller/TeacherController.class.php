<?php
namespace Home\Controller;
use Think\Controller;
class TeacherController extends CommonController {
	public function index(){
		$teacher   = M('teacher'); // 实例化Class对象

        //$result = $teacher->field("id, tNo, tName, address, phone, regTime, onlineTime")->select();
        
		$count   = $teacher->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $teacher->order('id')->limit($Page->firstRow.','.$Page->listRows)->field("id, tNo, tName, address, phone, regTime, onlineTime")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }
	
	public function detail(){
		$Model = new \Think\Model();

		$id = I("get.id");

		$sql1 = "select tNo, tName, sex, tIntro, address, phone, regTime, onlineTime from teacher where id = ".$id;
		$sql2 = "select c.className from teacher as a left join teacher_class as b on a.id = b.teacherId and b.auditStatus = 1 left join class as c on b.classId = c.id where a.id = ".$id;
		$sql3 = "select c.stuName  from teacher as a left join stu_class as b on a.id = b.teacherId left join student as c on b.stuId = c.id where a.id = ".$id;

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
			$sql = "select id, tNo, tName, sex, tIntro, address, phone, regTime, onlineTime from teacher where id = ".I("get.id");
			
			$this->assign("teacher", $Model->query($sql));
			$this->display('updateTeacher');
		}
		else{
			$this->display('addTeacher');
		}
	}

	public function checkName() {
		$a = $_POST['tNo'];
	 
        $user = D ('teacher');
        $res  = $user->where(array('tNo'=>$_REQUEST['tNo']))->find();
		if($a == ""){
			echo "不能为空！";
		}
		else if($res){
			echo "用户已存在！";
		}else{
			echo "可注册！";
		}
    }
	
	//等待认证教练列表
    public function checkAuditStatus(){
    	$teacher_class   = M('teacher_class'); // 实例化User对象

        //$result = $teacher_class->join("teacher ON teacher_class.teacherId = teacher.id", "LEFT")->join("class ON teacher_class.classId = class.id", "LEFT")->field("teacher_class.id, teacher.tNo, teacher.tName, class.className, teacher_class.applyTime, teacher.onlineTime, teacher_class.auditStatus")->where("teacher_class.auditStatus = 0")->select();

		$count   = $teacher_class->where("teacher_class.auditStatus = 0")->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $teacher_class->order('id')->limit($Page->firstRow.','.$Page->listRows)->join("teacher ON teacher_class.teacherId = teacher.id", "LEFT")->join("class ON teacher_class.classId = class.id", "LEFT")->field("teacher_class.id, teacher.tNo, teacher.tName, class.className, teacher_class.applyTime, teacher.onlineTime, teacher_class.auditStatus")->where("teacher_class.auditStatus = 0")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }
	
	//已完成认证教练列表
	public function AuditStatusFinish(){
    	$teacher_class   = M('teacher_class'); // 实例化User对象

        //$result = $teacher_class->join("teacher ON teacher_class.teacherId = teacher.id", "LEFT")->join("class ON teacher_class.classId = class.id", "LEFT")->field("teacher_class.id, teacher.tNo, teacher.tName, class.className, teacher_class.applyTime, teacher.onlineTime, teacher_class.auditStatus")->where("teacher_class.auditStatus = 0 or teacher_class.auditStatus = 2")->select();

		$count   = $teacher_class->where("teacher_class.auditStatus = 1 or teacher_class.auditStatus = 2")->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $teacher_class->order('id')->limit($Page->firstRow.','.$Page->listRows)->join("teacher ON teacher_class.teacherId = teacher.id", "LEFT")->join("class ON teacher_class.classId = class.id", "LEFT")->field("teacher_class.id, teacher.tNo, teacher.tName, class.className, teacher_class.applyTime, teacher.onlineTime, teacher_class.auditStatus")->where("teacher_class.auditStatus = 1 or teacher_class.auditStatus = 2")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }

    public function checkAuditStatusDetail(){
    	$Model = new \Think\Model();

    	$id = I("get.id");

		$sql = "select a.id, b.tNo, b.tName, b.sex, b.tIntro, b.address, b.phone, b.regTime, b.onlineTime, c.className, a.applyTime, a.reason, a.auditStatus from teacher_class as a left join teacher as b on a.teacherId = b.id left join class as c on a.classId = c.id where a.id = ".$id;

		$result = $Model->query($sql);

		$this->assign("list", $result);

		$this->display();
    }
	
	public function AuditStatusDetail(){
    	$Model = new \Think\Model();

    	$id = I("get.id");

		$sql = "select a.id, b.tNo, b.tName, b.sex, b.tIntro, b.address, b.phone, b.regTime, b.onlineTime, c.className, a.applyTime, a.reason, a.auditStatus from teacher_class as a left join teacher as b on a.teacherId = b.id left join class as c on a.classId = c.id where a.id = ".$id;

		$result = $Model->query($sql);

		$this->assign("list", $result);

		$this->display();
    }
	
    public function updateAuditStatus(){
    	$Model = new \Think\Model();

    	$id = I("post.id");
    	$auditStatus = I("post.auditStatus");

		$sql = "update teacher_class set auditStatus = ".$auditStatus." where id = ".$id;

		$Model->execute($sql);
		
		$this->success('已认证','checkAuditStatus');
    }
	
	public function add(){
        $teacher = M("teacher");
		if($teacher->create()){
			$result = $teacher->add(); // 写入数据到数据库 
		}
		$this->success('添加成功！','index');
    }

	public function update(){
        $teacher = M("teacher");
		if($teacher->create()){
			$teacher->save(); // 修改数据到数据库 
		}
		$this->success('修改成功！','index');
    }

	public function delete(){
        $teacher = M("teacher");
		$teacher->delete(I("get.deleteID"));
		$this->success('删除成功！','index');
    }
}