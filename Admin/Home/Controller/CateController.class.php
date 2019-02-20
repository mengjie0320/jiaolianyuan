<?php
namespace Home\Controller;
use Think\Controller;
class CateController extends CommonController {
    public function index(){
        $cate   = M('cate'); // 实例化User对象
    	
        //$result = $cate->field("id, cNo, cName")->select();

		$count   = $cate->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $cate->order('id')->limit($Page->firstRow.','.$Page->listRows)->field("id, cNo, cName")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }
	
	 public function listC(){
        $cate   = M('cate'); // 实例化User对象
    	
        //$result = $cate->field("id, cNo, cName")->select();

		$count   = $cate->count();// 查询满足要求的总记录数
		$Page    = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(2)
		
		$Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
		$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
		$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
		$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
		//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
		$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
		$show       = $Page->show();// 分页显示输出
		
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $cate->order('id')->limit($Page->firstRow.','.$Page->listRows)->field("id, cNo, cName")->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    }
	

	public function prepare($mode){  //进入添加界面或编辑界面之前提供分类列表和项目列表的函数
		$Model = new \Think\Model();
	
		if($mode == 'update'){
			$sql = "select id, cNo, cName from cate where id = ".I("get.id");
			
			$this->assign("cate", $Model->query($sql));
			$this->display('updateCate');
		}
		else{
			$this->display('addCate');
		}
	}

	public function add(){
        $cate = M("cate");
		if($cate->create()){
			$cate->add(); // 写入数据到数据库 
		}
		$this->success('添加成功！','listC');
    }

	public function checkNo() {
		$a = $_POST['cNo'];
	 
        $user = D ('cate');
        $res  = $user->where(array('cNo'=>$_REQUEST['cNo']))->find();
		if($a == ""){
			echo "不能为空！";
		}
		else if($res){
			echo "分类号已存在！";
		}else{
			echo "可注册！";
		}
    }
	
	public function checkName() {
		$b = $_POST['cName'];
	 
        $user = D ('cate');
        $res  = $user->where(array('cName'=>$_REQUEST['cName']))->find();
		if($b == ""){
			echo "不能为空！";
		}
		else if($res){
			echo "分类名称已存在！";
		}else{
			echo "可注册！";
		}
    }
	
	public function update(){
        $cate = M("cate");
		if($cate->create()){
			$cate->save(); // 修改数据到数据库 
		}
		$this->success('修改成功！','listC');
    }

	public function delete(){
        $Model = new \Think\Model();

		$deleteID = I("get.deleteID");

		$sql = "select classCate from class where classCate = ".$deleteID;
		$result = $Model->query($sql);
		if($result == null){    //表明这个分类下面没有班级，可以放心删除这个分类
			
			M("project_cate")->where("cateId = ".$deleteID)->delete();

			M("cate")->delete($deleteID);   

			$this->success('删除成功！', 'listC');
		}
		else{
			$this->error('分类下面存在班级，不能删除该分类！');
		}
    }
}