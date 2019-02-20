<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends Controller {
    public function index(){

		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
		
		
    	$getCourseCate = $this -> getCourseCate();
		$this -> assign('getCourseCate', $getCourseCate);
		
		$hotClassList = $this -> hotClass();
		$this -> assign('hotClassList',$hotClassList);

        $phpData = $this -> phpEngineer();
		$this -> assign('phpData',$phpData);
		

        $this -> display();
	}
	
	
	  /** 
		* 
		* 获取课程分类栏
		* 
		* @param  无
		* 
		*
		*/ 
	    public function getCourseCate()
	 {

	 	$cate = M("cate");
		
//		$courseCate = "courseCate"; //缓存下标
	 	$cache=S("$courseCate");
		//没缓存
       if($cache==NULL)
       {   
       	$where['pId'] = 0;
		$getCourseCate = $cate -> field('id,cname') -> where($where) -> select(); //课程分类栏课程名字
        S("$courseCate",$getCourseCate,300); //写入缓存，时间300s  
		return $getCourseCate;
	   }
	   //有缓存
	   else
	   {
	   	return $cache;
	   }
    
	 }
		
		
		/*
		 *获取大的分类栏下的班级，要传参数,暂时不用++
		 */
/*		public function getClassList()
	 {
        
	 	 $class = M("class");
		 $course = M('cate');
		 $where['cName'] = $_GET['cname'];
		 $cname = $_GET['cname']; //设置缓存下标
	 	 $cache=S($cname);
		 //没有缓存
	        if($cache==NULL)
		  {
		  	 //获取分类栏课程的id
			 $courseId = $course -> field('id') -> where($where) -> select(); 
	         $courseId = (int)($courseId[0]['id']);
	
	         //获取大的分类栏id为$courseId下的班级
			 $classList = $class -> field('id,className') ->where('classCate='.$courseId) ->select();
			 //该分类下有班级
			 if ($classList  != NULL) {
				$return["ret"] = "200";
				$return["data"] = $classList;
				$return["msg"] = "";
				S("$cname",$return,120); //写入缓存，时间120s  
				$this -> ajaxReturn($return);
			} 
			//该分类下没有班级
			else 
			{
				$return["ret"] = "400";
				$return["data"] = "此课程暂无班级";
				$return["msg"] = "";
				S("$cname",$return,120); //写入缓存，时间120s  
				$this -> ajaxReturn($return);
			}
		  }
		  //有缓存
		 else
		 {
		 	   // S("$cname",null);
				$this -> ajaxReturn($cache);
		  }
		
		
	}	
*/
	 
	  /*
	  * 获取热门班级的人数
	  */
	  public function hotClass()
	 {

		 $model= new Model();
	 	 
		 $cacheIndex = "hotClass";   //设置缓存下标
	 	 $cache = S("$cacheIndex");
		 //没有缓存
	     if($cache == NULL)
		 {
			 for($i = 1; $i < 6; $i++ )
			 {
			  $no = $i - 1; 
		      $classId = $model -> query(" select count(classId) from `stu_class` group by classId limit $no,1");
			  $classId = (int)($classId[0]['count(classid)']);
			  $data[$i] = $model -> query("select * from (select class.id,className,classIntro,classPic from `class` left join `stu_class` on class.id = classId) as a where id = $classId");
			  $data += $data;
			 }
			 S("$cacheIndex",$data,120); //写入缓存，时间120s  
			 return $data;
		 }
		 //有缓存
		 else
		 {
			 return $cache;
		  	 
		  }
	}
	 
	   /*
	    * PHP工程师,
	    */
	 	public function phpEngineer() 
		{
		 $model =new Model();
		 $course = M('cate');
		 $class = M("class");
		 $cname = 'PHP工程师';
		 $where['cname'] = $cname;
         
         $phpEngineer = "php";//缓存下标
		 $cache2 = S("$phpEngineer");
	     if($cache2 == NULL)
		 {
         //这两句找出PHP工程师对应的id ,即是父级ID
		 $result = $course -> field('id') -> where($where) -> limit(0,1) -> select();
		 $id = (int)($result[0]['id']);
		 //找出8张PHP工程师的班级的图片
		 
//		  $data[$i] = $model -> query("select * from (select class.id,className,classIntro,classPic from `class` left join `cate` on class.id = classId where classId=$id) as a ");
//		  $data['php'] = $model -> query("select * from ((select class.id,className,classIntro,classPic from `class` where classCate=$id) as a left join `stu_class` on a.id=`stu_class`.classId)");
		 $data = $class -> field('id,classPic,classIntro,className') ->where('classCate='.$id) -> limit(3,8) -> select();
//		 dump($data);
		 S("$phpEngineer",$data,120); //写入缓存，时间120s  
		 return $data; 
		 }
		  //有缓存
		 else
		  {
		   return $cache2;
		  }
		 
		}
		
		
	/*
	 * 搜索，暂时通过班级名来查询
	 */
	 public function search()
	 {
	 	$class = M('class');
		$searchContent = $_GET['searchContent'];
		if($searchContent != null)
		{
			//模糊查询相应的班级
	        $where['className'] = array('like',"%{$searchContent}%");
			$className = $class -> where($where) -> field('id,className') -> limit(0,5) -> select(); 
			//有相关班级
			if($className != null)
			{
		 	$data['ret'] = "200";
		 	$data['data'] = $className;
			$data['msg'] = "";
			$this -> ajaxReturn($data);
			}
			//没有相关班级
	        else
	        {
	        $data['ret'] = "400";
		 	$data['data'] = "无相关班级";
			$data['msg'] = "";
			$this -> ajaxReturn($data);
	        }
        }
        //搜索内容为空
        else 
        {
        	$data['ret'] = "400";
		 	$data['data'] = "搜索内容不能为空";
			$data['msg'] = "";
			$this -> ajaxReturn($data);
        }
	 }


		/*
		 *点击获取大的分类栏下的班级  
		 * @Param String id
		 */
//		public function classList()
//	 {
//	 	
//		$name = $_SESSION['name'];
//		$face = $_SESSION['face'];
//		$identity = $_SESSION['identity'];
//      $this->assign('name',$name);
//		$this->assign('face',$face);
//		$this->assign('identity',$identity);
//		
//      
//	 	 $class = M("class");
//		 $stu_class = M('stu_class');
//		 $course = M('cate');
//		 $where['classCate'] = $_GET['id'];
//
//	     $classList = $class -> field('id,className,classPrice,classPic') -> where($where) ->select();
//
//	     $this -> assign('classlist',$classList);
//   	
//		 $courseCate = $this -> getCourseCate();
//		 $this -> assign('coursecate', $courseCate);
//		 
//		$this -> display();
//	}


	/*
	 * 分页,课程下的班级列表
	 * */
	public function classList2()
	{
		
		$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
		
		$class = M("class");
		$stu_class = M('stu_class');
		$course = M('cate');
		$where['classCate'] = $_GET['id'];
		$count = $class -> where($where) ->count();  //计算总的班级数目
		$classListPage = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$classListshow = $classListPage -> show();// 分页显示输出
		$firstRow = $classListPage->firstRow;
		$listRows = $classListPage->listRows;
        //某一页的班级
        $classList = $class -> field('id,className,classPrice,classPic') -> where($where) -> limit($firstRow,$listRows) -> select();
        // 赋值数据集
		$this->assign('classList',$classList);
		// 赋值分页输出
		$this->assign('classListPage',$classListshow);
		
		//获取课程分类
		$courseCate = $this -> getCourseCate();
		$this -> assign('coursecate', $courseCate);
		
		$this -> display();
	}
     
    /*
     * 某个班级的项目个数
     */	
	public function projectNum()
	{
		$class = M("class");
		$class_project = M('class_project');
		
		$where['classId'] = $_GET['classId'];  //班级id
		$count = $class_project -> where($where) -> count();
		if ($count >= 0) {
			$return["ret"] = "200";
			$return["data"] = $count;
			$return["msg"] = "";
			$this -> ajaxReturn($return);
		} else {
			$return["ret"] = "400";
			$return["data"] = "暂无项目";
			$return["msg"] = "";
			$this -> ajaxReturn($return);
		}
	}

   
    /*
     * 获取某一级分类下的二级分类
     */
    public function getSecondCate()
    {
    	$cate = M('cate');
    	$where['pId'] = $_GET['id'];  //获取一级分类的id
    	$secondCateList = $cate -> where($where) -> select();
    	if ($secondCateList  != NULL) 
    	{
			$return["ret"] = 200;
			$return["data"] = $secondCateList;
			$return["msg"] = "";
			$this -> ajaxReturn($return);
		} 
			//该分类下没有班级
			else 
			{
			$return["ret"] = 400;
			$return["data"] = "此课程暂无分类";
			$return["msg"] = "";
			$this -> ajaxReturn($return);
			}
    }
    
    
//  /*
//   * 玩玩   获取某二级分类下的班级
//   */
//  public function getSecondCateClass()
//  {
//  	$class = M('class');
//  	$where['classCate'] = $_GET['classCate'];
//  	$secondCateClass = $class -> where($where) -> select();
//  	$this -> ajaxReturn($secondCateClass);
//  }


     /*
      * 获取大分类下的班级
      */
     public function classList()
     {
     	$name = $_SESSION['name'];
		$face = $_SESSION['face'];
		$identity = $_SESSION['identity'];
        $this->assign('name',$name);
		$this->assign('face',$face);
		$this->assign('identity',$identity);
     	
     	
//   	$classListPage = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
//		$classListshow = $classListPage -> show();// 分页显示输出
//		$firstRow = $classListPage->firstRow;
//		$listRows = $classListPage->listRows;
//   	
     	$model = new Model();
     	$id = $_GET['id'];
     	$cate = M('cate');
     	$result = $cate -> where("id=".$id) -> find();
        //传入的为父级id
     	if($result['pid'] == 0)
     	{

     		$count = $model -> query("select count(*) from class where classCate in (select id from cate where pId =$id)");
     		$count = $count[0]['count(*)'];
     		$classListPage = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$classListshow = $classListPage -> show();// 分页显示输出
			$firstRow = $classListPage->firstRow;
			$listRows = $classListPage->listRows;
     		$classList = $model -> query("select * from class where classCate in (select id from cate where pId =$id) limit $firstRow,$listRows");
		
     	}
     	//传入的为二级分类
     	else
     	{
     		$count = $model -> query("select count(*) from class where classCate=$id");
     		$count = $count[0]['count(*)'];
     		$classListPage = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$classListshow = $classListPage -> show();// 分页显示输出
			$firstRow = $classListPage->firstRow;
			$listRows = $classListPage->listRows;
     		$classList = $model -> query("select * from class where classCate=$id limit $firstRow,$listRows");
			
     	}
     	
     	
//      //某一页的班级
//      $classList = $class -> field('id,className,classPrice,classPic') -> where($where) -> limit($firstRow,$listRows) -> select();
        // 赋值数据集
		$this->assign('classList',$classList);
		// 赋值分页输出
		$this->assign('classListPage',$classListshow);
		
		//获取课程分类
		$courseCate = $this -> getCourseCate();
		$this -> assign('coursecate', $courseCate);
		
		$this -> display();

     }

}