<?php
namespace Home\Controller;
use Think\Controller;
class ClassController extends CommonController {
    public function index(){ 
        $class   = M('class'); // 实例化Class对象

        //$result = $class->join("cate ON class.classCate = cate.id", "LEFT")->field("class.id, class.classNo, class.className, class.classPrice, class.startTime, class.classIntro, class.avePeriod, cate.cName")->select();

		//$this->assign("list", $result);
		
		$count   = $class->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $class->order('id')->limit($Page->firstRow.','.$Page->listRows)->join("cate ON class.classCate = cate.id", "LEFT")->field("class.id, class.classNo, class.className, class.classPrice, class.startTime, class.classIntro, class.avePeriod, cate.cName")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板

		
    }

	public function detail(){
		$Model = new \Think\Model();

		$id = I("get.id");

		//班级基本信息
		$sql1 = "select a.id, a.classNo, a.className, a.coachMinPrice, a.coachMaxPrice, a.classPic, a.classPrice, a.startTime, a.classIntro, a.avePeriod, b.cName, a.requirement, a.studyResult from class as a left join cate as b on a.classCate = b.id where a.id = ".$id;

		//班级所有教练
		$sql2 = "select b.tName from teacher_class as a left join teacher as b on a.teacherId = b.id where a.classId = ".$id;
		
		//班级所有项目名称
		$sql3 = "select b.name from class_project as a left join project as b on a.projectId = b.id where a.classId = ".$id;

		//班级所有学员名称
		$sql4 = "select b.stuName from stu_class as a left join student as b on a.stuId = b.id where a.classId = ".$id;

		$result_1 = $Model->query($sql1);
		$result_2 = $Model->query($sql2);
		$result_3 = $Model->query($sql3);
		$result_4 = $Model->query($sql4);

		$this->assign("list_1", $result_1);
		$this->assign("list_2", $result_2);
		$this->assign("list_3", $result_3);
		$this->assign("list_4", $result_4);

		$this->display();
	}

	public function prepare($mode){  //进入添加界面或编辑界面之前提供分类列表和项目列表的函数
		$Model = new \Think\Model();

		
		$sql1 = "select id, cName from cate";
		$this->assign("cate_list", $Model->query($sql1));

		if($mode == 'update'){

			//选择班级基本信息
			$sql2 = "select id, classNo, coachMinPrice, coachMaxPrice, className, classPrice, startTime, classIntro, avePeriod, requirement, classCate, studyResult from class where id = ".I("get.id");

			//选择该班级对应分类下的所有项目
			$sql3 = "select d.name from class as a left join cate as b on a.classCate = b.id left join project_cate as c on b.id = c.cateId left join project as d on c.projectId = d.id where a.id = ".I("get.id");

			//选择班级已有的项目
			$sql4 = "select c.name from class as a left join class_project as b on a.id = b.classId left join project as c on b.projectId = c.id where a.id = ".I("get.id");

			$this->assign("class", $Model->query($sql2));
			$this->assign("project_list", $Model->query($sql3));
			$this->assign("class_project_list", $Model->query($sql4));
			$this->display('updateClass');
		}
		else{
			$this->display('addClass');
		}
	}

	public function ajax(){
		// $image = $_POST['image'];
		// $image = base64_decode($image);
		// $image_src = './jiaolianyuan/Public/images/'.date("Ymdhis").rand(0,9999).'.jpg';
		// file_put_contents($image_src, $image);
		
		
		// // dump($_FILES);
		// // dump($image_src);
		
		// // echo "fsdfasfasdfafd";
		
		
		
		
		$this->ajaxReturn($image_src);
    }

	public function add(){
		$class = M("class");
		
		$upload = new \Think\Upload();
		//实例化上传类
		$upload -> maxSize = 3145728;
		// 设置附件上传大小 2M = 1024*1024*2=2097152 3M = 1024*1024*3=3145728
		$upload ->exts = array('jpg', 'jpeg', 'png', 'gif');
		$upload -> rootPath = './Public/images/';
		$info = $upload -> uploadOne($_FILES['classPic']);
		$data['face'] = $info['savepath'].$info['savename'];
		$classPic = $data['face'];
		
		$_POST['classPic'] = $classPic;
		
		unset($_POST['c12']);
		
		// dump($_POST);
		
		
		
		
		
		
		if($class->create()){
			
			$insertID = $class->add(); // 写入基本数据到数据库 
		}
		
		//先插入基本的数据值，获取到新增的主键值再做关联表的添加
		$class_project['classId'] = $insertID;
		//复选框提交值的处理（从test表的name找到id值）
		foreach(I("post.project") as $projectname){
			$project['name'] = $projectname;
			$class_project['projectId'] = M("project")->where($project)->getField("id");

			//接下来就可以插入关联表了
			M("class_project")->add($class_project);
		}
        $this->success('添加成功！', 'index');
		
		
		
		
		
		
    }
	
	public function checkProject() {
		$a = $_POST['id'];
         $Model = new \Think\Model();
		 $sql1 = "select a.name from project as a left join project_cate as b on a.id = b.projectId left join cate as c on b.cateId = c.id where c.id = $a";
		 $res = $Model->query($sql1);
		 $this->ajaxReturn($res) ;
		
		  // for ($i= 0;$i< count($res); $i++){ 
		 
		   // echo $res[$i][name]; 
        // } ;
    }

	public function checkNo() {
		$a = $_POST['classNo'];
	 
        $user = D ('class');
        $res  = $user->where(array('classNo'=>$_REQUEST['classNo']))->find();
		if($a == ""){
			echo "不能为空！";
		}
		else if($res){
			echo "班级号已存在！";
		}else{
			echo "可添加！";
		}
    }
	
	public function checkName() {
		$b = $_POST['className'];
	 
        $user = D ('class');
        $res  = $user->where(array('className'=>$_REQUEST['className']))->find();
		if($b == ""){
			echo "不能为空！";
		}
		else if($res){
			echo "班级名称已存在！";
		}else{
			echo "可添加！";
		}
    }
	
	
	public function update(){
        $class = M("class");
		if($class->create()){
			$class->save(); // 修改数据到数据库 
		}
		//先得到要修改的班级id，然后在关联表中删除所有与该班级id相关联的项目id，最后再添加上去
		$class_project['classId'] = I("post.id");
		M("class_project")->where($class_project)->delete();

		foreach(I("post.project") as $projectname){
			$project['name'] = $projectname;
			$class_project['projectId'] = M("project")->where($project)->getField("id");

			M("class_project")->add($class_project);
		}

		$this->success('修改成功！', 'index');
    }

	public function delete(){
		$Model = new \Think\Model();

		$deleteID = I("get.deleteID");
        
		$sql = "select id from stu_class where classId = ".$deleteID." and graduateStatus = 0";
		$result = $Model->query($sql);
		if($result == null){    //表明这个班级的所有学生均已毕业，可以放心删除这个班级
			//先删除关联表的信息，再删除班级表的班级信息（因为关联表的信息是以班级表为基础，不能破坏外键参照完整性）
			M("stu_class")->where("classId = ".$deleteID)->delete();
			M("stu_project")->where("classId = ".$deleteID)->delete();
			M("class_project")->where("classId = ".$deleteID)->delete();
			M("teacher_class")->where("classId = ".$deleteID)->delete();

			M("class")->delete($deleteID);   

			$this->success('删除成功！', 'index');
		}
		else{
			$this->error('尚有学生未毕业，不能删除该班级！');
		}
		
    }
}