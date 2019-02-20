<?php
namespace Home\Controller;
use Think\Controller;
class WorkController extends CommonController {
    public function index(){
        $work   = M('work'); // 实例化User对象

        //$result = $work->join("student ON work.stuId = student.id", "LEFT")->join("class ON work.classId = class.id", "LEFT")->join("project ON work.projectId = project.id", "LEFT")->field("work.id, student.stuName, class.className, project.name, work.submitTime, work.finishedTime, work.workUrl, work.remark, work.remarkTime, work.status")->where("work.status = 0")->select();
        
		$count   = $work->where("work.status = 0")->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $work->order('id')->limit($Page->firstRow.','.$Page->listRows)->join("student ON work.stuId = student.id", "LEFT")->join("class ON work.classId = class.id", "LEFT")->join("project ON work.projectId = project.id", "LEFT")->field("work.id, student.stuName, class.className, project.name, work.submitTime, work.finishedTime, work.workUrl, work.remark, work.remarkTime, work.status")->where("work.status = 0")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }
	
	 public function listW(){
         $work   = M('work'); // 实例化User对象

        //$result = $work->join("student ON work.stuId = student.id", "LEFT")->join("class ON work.classId = class.id", "LEFT")->join("project ON a.projectId = project.id", "LEFT")->field("work.id, student.stuName, class.className, project.name, work.submitTime, work.finishedTime, work.workUrl, work.remark, work.remarkTime, work.status")->where("work.status != 0")->select();
        
		$count   = $work->where("work.status != 0")->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $work->order('id')->limit($Page->firstRow.','.$Page->listRows)->join("student ON work.stuId = student.id", "LEFT")->join("class ON work.classId = class.id", "LEFT")->join("project ON work.projectId = project.id", "LEFT")->field("work.id, student.stuName, class.className, project.name, work.submitTime, work.finishedTime, work.workUrl, work.remark, work.remarkTime, work.status")->where("work.status != 0")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }
	
	 public function detail($id){
        $Model = new \Think\Model();

		$sql = "select a.id, b.stuName, d.className, e.name, a.submitTime, a.finishedTime, a.workUrl, a.remark, a.remarkTime, a.rank, a.status from work as a left join student as b on a.stuId = b.id left join stu_class as c on a.stuId = c.stuId and graduateStatus = 0 left join class as d on c.classId = d.id left join project as e on a.projectId = e.id where a.id = ".$id;

		$result = $Model->query($sql);
		$this->assign("list", $result);

		$this->display();
    }
	

	public function prepareForEvaluate($id){  //进入评阅界面之前提供评阅内容和作业状态的函数
		$Model = new \Think\Model();

		$sql = "select id, remark, status from work where id = ".$id;
		$sql2 = "select a.id, a.stuId, a.classId, b.stuName, d.className, e.name, a.submitTime, a.finishedTime, a.workUrl, a.remark, a.remarkTime, a.status from work as a left join student as b on a.stuId = b.id left join stu_class as c on a.stuId = c.stuId and graduateStatus = 0 left join class as d on c.classId = d.id left join project as e on a.projectId = e.id where a.id = ".$id;
		$this->assign("content", $Model->query($sql));
		$this->assign("content2", $Model->query($sql2));

		$this->display('evaluate');
	}

	public function evaluate(){
		$Model = new \Think\Model();

		$id = I("post.id");
		$data['remark'] = I("post.remark");
		$data['rank'] = I("post.rank");
		$data['remarkTime'] = date('Y-m-d H:i:s');
		$data['status'] = I("post.status");
		//echo $data['status'];
		M("work")->where("id = ".$id)->save($data);

		 
		$work = M('work');
		$class_project = M('class_project');
		$stu_class = M('stu_class');

		//查询某学生在某班级已完成的项目数
		$where['stuId'] = $_POST['stuId'];
		$where['classId'] = $_POST['classId'];
		$finishedCount = $work -> where($where) -> count();

		//查询某个班级的项目数量
		$classId['classId'] = $_POST['classId'];
		$classProjectCount = $class_project -> where($classId) -> count();
		var_dump($finishedCount);
		var_dump($_POST);
		//所有项目都已经做完
		if($finishedCount == $classProjectCount)
		{
			$data['graduateStatus'] = 1; //1已毕业
			$stu_class -> where($where) -> save($data); //把该学生在该班级的的毕业情更新为已毕业
		}
		$this->success('评阅成功！', 'index');
	}

}