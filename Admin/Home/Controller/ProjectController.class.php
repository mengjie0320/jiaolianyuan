<?php
namespace Home\Controller;
use Think\Controller;
class ProjectController extends CommonController {
    public function index(){
        $project   = M('project'); // 实例化User对象

        //$result = $project->join("project_cate ON project.id = project_cate.projectId", "LEFT")->join("cate ON project_cate.cateId = cate.id", "LEFT")->field("project.id, project.name, project.requireTime, project.dataUrl, cate.cName")->select();

		$count   = $project->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $project->order('id')->limit($Page->firstRow.','.$Page->listRows)->join("project_cate ON project.id = project_cate.projectId", "LEFT")->join("cate ON project_cate.cateId = cate.id", "LEFT")->field("project.id, project.name, project.requireTime, project.dataUrl, cate.cName")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }

	public function detail(){
		$Model = new \Think\Model();

		$id = I("get.id");

		//项目基本信息
		$sql = "select a.*, c.cName from project as a left join project_cate as b on a.id = b.projectId left join cate as c on b.cateId = c.id where a.id = ".$id;

		$result = $Model->query($sql);
		$this->assign("list", $result);

		$this->display();
	}

	public function prepare($mode){  //进入添加界面或编辑界面之前提供分类列表和项目列表的函数
		$Model = new \Think\Model();

		$sql1 = "select id, cName from cate";
		$this->assign("cate_list", $Model->query($sql1));

		if($mode == 'update'){
			$sql2 = "select * from project where id = ".I("get.id");
			$sql3 = "select b.id, b.cname from project_cate as a left join cate as b on a.cateId = b.id where a.projectId = ".I("get.id");

			$this->assign("project", $Model->query($sql2));
			$this->assign("project_cate_list", $Model->query($sql3));
			$this->display('updateProject');
		}
		else{
			$this->display('addProject');
		}
	}

	public function add(){
		$project = M("project");
		if($project->create()){
			$insertID = $project->add(); // 写入基本数据到数据库 
		}
		//先插入基本的数据值，获取到新增的主键值再做关联表的添加
		$project_cate['projectId'] = $insertID;
		//单选框提交值的处理
		$project_cate['cateId'] = I("post.cateId");

		//接下来就可以插入关联表了
		M("project_cate")->add($project_cate);
		
        $this->success('添加成功！', 'index');
    }
	
	public function checkName() {
		$b = $_POST['name'];
	 
        $user = D ('project');
        $res  = $user->where(array('name'=>$_REQUEST['name']))->find();
		if($b == ""){
			echo "不能为空！";
		}
		else if($res){
			echo "项目名称已存在！";
		}else{
			echo "可注册！";
		}
    }

	public function update(){
        $project = M("project");
		if($project->create()){
			$project->save(); // 修改数据到数据库 
		}
		//先得到要修改的项目id，然后在关联表中删除所有与该项目id相关联的分类id，最后再添加上去
		$project_cate['projectId'] = I("post.id");
		M("project_cate")->where($project_cate)->delete();

		$project_cate['cateId'] = I("post.cateId");

		M("project_cate")->add($project_cate);

		$this->success('修改成功！', 'index');
    }

	public function delete(){
		$Model = new \Think\Model();

		$deleteID = I("get.deleteID");
        
		$sql = "select id from stu_project where projectId = ".$deleteID." and status = 0 union select id from class_project where projectId = ".$deleteID;
		$result = $Model->query($sql);
		if($result == null){    //表明没有学生和班级使用该项目，可以放心删除这个项目
			
			//先删除关联表的信息，再删除项目表的班级信息（因为关联表的信息是以项目表为基础，不能破坏外键参照完整性）
			M("stu_project")->where("projectId = ".$deleteID)->delete();
			M("class_project")->where("projectId = ".$deleteID)->delete();
			M("project_cate")->where("projectId = ".$deleteID)->delete();

			M("project")->delete($deleteID);   

			$this->success('删除成功！', 'index');
		}
		else{
			$this->error('尚有学生未完成本项目，不能删除该项目！');
		}
		
    }
}