$(function(){

//侧边栏鼠标滑过显示二级菜单
$(function(){
	$(".first-list").mouseover(function(){
		$(this).addClass("active").children("ul").show();
	});
	$(".first-list").mouseout(function(){
		$(this).removeClass("active").children("ul").hide();
	});
})
//轮播
$(function(){
    var i=0;
    var big_banner_pic = $("#banner_pic");
    var allimg=$("#banner_pic li").length;
    function img_change(){
        var img_i=i*-1200+"px";
        big_banner_pic.animate({opacity:".2"},100,function(){
            big_banner_pic.css("left",img_i );
            big_banner_pic.animate({
                opacity: "1"
            }, 100);
        })
    }
    function automatic(){
        i+=1;
        if(i>=allimg){
            i=0;
        }
        img_change();
    }
    change_self_time = setInterval(automatic, 3000);
    //轮播上一张下一张图标控制
    $("#banner_change_wrap").hover(function(){
        clearInterval(change_self_time);
        $("#banner_change_wrap").children().show();
    },function(){
        change_self_time = setInterval(automatic, 3000);
        $("#banner_change_wrap").children().hide();
    })
    $("#prev").click(function(){
        i += 1;
        if (i >= allimg) {
            i = 0;
        }
        img_change();
    })
    $("#next").click(function(){
        i -= 1;
        if (i <0) {
            i = allimg-1;
			
        }
        img_change();
    })
    
})
$(function(){
//热门课程中显示详情
	$(".hot-recomendation ul li").hover(function(){
		$(this).find(".tip_info").animate({
				top:"50px",
		},{duration:100,easing:"linear"});
		
	},function(){
		$(this).find(".tip_info").animate({
				top:"98px",
		},{duration:100,easing:"linear"});
	});
	//鼠标滑过课程详情缓慢滑出到固定高度
	$(".classes-right ul li").hover(function(){
		$(this).find(".pic_info").slideDown().animate({height:"218px"});
	},function(){
		$(this).find(".pic_info").slideUp().animate({height:"0px"});
	});

	$(".footer_1").find('img').hover(function(){
		var src= $(this).attr('src');
		var path=src.replace(1,2);
		$(this).attr('src',path);
	
	},
	function(){
		var aa= $(this).attr('src');
		var path=aa.replace(2,1);
//		alert(path);
		$(this).attr('src',path);
	})
	$("#weixin").hover(function(){
		$(".weixin").css("display","block")
	},function(){
		$(".weixin").css("display","none")
	})
})
$(document).ready(function(){
//限制字符个数
$(".small_word").each(function(){
var maxwidth=35;
if($(this).text().length>maxwidth){
$(this).text($(this).text().substring(0,maxwidth));
$(this).html($(this).html()+"...");
}
});
});


})
