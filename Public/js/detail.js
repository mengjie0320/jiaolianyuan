//选项卡
window.onload=function(){
	function $(id){
	return typeof id==='string'?document.getElementById(id):id;
}
// 标签的索引
var index=0;
var timer=null;

    var lis=$('notice-tit').getElementsByTagName('li'),
      divs=$('notice-child').getElementsByTagName('div');
      


if(lis.length!=divs.length) return;

// 遍历所有的页签
for(var i=0;i<lis.length;i++){
    lis[i].id=i;
    lis[i].onclick=function(){
      // 用that这个变量来引用当前滑过的li
      var that=this;
      // 如果存在准备执行的定时器，立刻清除，只有当前停留时间大于500ms时才开始执行
      if(timer){
        clearTimeout(timer);
        timer=null;
      }
      // 延迟半秒执行
      timer=window.setTimeout(function(){
        for(var j=0;j<lis.length;j++){
          lis[j].className='';
          divs[j].style.display='none';
        }
        lis[that.id].className='select';
        divs[that.id].style.display='block';
      },100);
    }
}

};
//点击出现摸态框
$(function(){
//	$(".show-div").click(function(){
		$(".notice_con ul li").click(function(){
			var clickId = $(this).attr("id");
			
//		var box =300;
//		var bw =$(".show-box").outerHeight();
//		var bh =$(".show-box").outerWidth();
//		
//		 var top = ($(window).height() - bw) / 2-box;  
//       var left =($(window).width() - bh) / 2-box; 
//获取浏览器窗口和滚动条的宽高来使得模态框居中显示
		var box =300;
		var top= $(window).scrollTop()+$(window).height()/1.8-box;
		var  left=$(window).width()/2-box;
//       alert(top+' '+left);
//打开模态框
//console.log("display"+clickId);
		$("#display"+clickId).animate({top:top,left:left,opacity:'show',width:600,height:340},500);
//		alert("display"+clickId);
//遮罩效果		
		$("#cover").css({
			display:"block",height:$(document).height()
		});
		return false;
	});
//关闭模态框
	$(".show-box .close").click(function(){
		$(this).parents(".show-box").animate({top:0,opacity: 'hide',width:0,height:0,right:0},500);
		$("#cover").css("display","none");
	});
});
$(document).ready(function(){
		$("#class_num").find(".pre").hide();//初始化为第一版
		var page=1;//初始化当前的版面为1
		var $show=$("#class_num").find(".zzsc_box");//找到图片展示区域
		var page_count=$show.find("ul").length;
		var $width_box=$show.parents("#wai_box").width();//找到图片展示区域外围的div
		function nav(){
			if(page==1){
				$("#class_num").find(".pre").hide().siblings(".next").show();
			}else if(page==page_count){
				
				$("#class_num").find(".next").hide().siblings(".pre").show();
			}else{
				$("#class_num").find(".pre").show().siblings(".next").show();
			}
		}
		$("#class_num").find(".next").click(function(){
			//首先判断展示区域是否处于动画
			if(!$show.is(":animated")){
				$show.animate({left:'-='+$width_box},"normal");
				page++;
				nav();
				$number=page-1;
				$("#class_num").find(".nav a:eq("+$number+")").addClass("now").siblings("a").removeClass("now");
				return false;
			}
		})
		$("#class_num").find(".pre").click(function(){
		if(!$show.is(":animated")){
			$show.animate({left:'+='+$width_box},"normal");
			page--;
			nav();
			$number=page-1;
			$("#class_num").find(".nav a:eq("+$number+")").addClass("now").siblings("a").removeClass("now");
			}
			return false;
		})
		$("#class_num").find(".nav a").click(function(){
				$index=$(this).index();
				page=$index+1;
				nav();
				$show.animate({left:-($width_box*$index)},"normal");	
				$(this).addClass("now").siblings("a").removeClass("now");
				return false;
		})
						   
});

$(function(){
	$('.move-list li:even').addClass('lieven');
	
	$("div.move-list").myScroll({
		speed:40, //数值越大，速度越慢
		rowHeight:56 //li的高度
	});
	
})




