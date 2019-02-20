//侧边栏鼠标滑过显示二级菜单
$(function(){
	$(".class-list li").mouseover(function(){
		$(this).addClass("active").children("ul").show();
	});
	$(".class-list li").mouseout(function(){
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

//热门课程中显示详情
$(function(){
	$(".hot-classes ul li").hover(function(){
		$(this).find(".tip-info").animate({
				top:"50px",
		},{duration:100,easing:"linear"});
		
	},function(){
		$(this).find(".tip-info").animate({
				top:"98px",
		},{duration:100,easing:"linear"});
	});
})

//限制字符个数
$(document).ready(function(){
$(".class-info").each(function(){
	var maxwidth=35;
	if($(this).text().length>maxwidth){
	$(this).text($(this).text().substring(0,maxwidth));
	$(this).html($(this).html()+"...");
	}
});
});


//回到顶部
$(function(){
function jiaolianyuan(){
	this.init();
}
jiaolianyuan.prototype = {
	constructor: jiaolianyuan,
	init: function(){		
		this._initBackTop();
	},	
	_initBackTop: function(){
		var $backTop = this.$backTop = $('<div class="cbbfixed">'+
						'<a class="cweixin cbbtn"">'+
							'<span class="weixin-icon"></span><div></div>'+
						'</a>'+
						'<a class="gotop cbbtn">'+
							'<span class="up-icon"></span>'+
						'</a>'+
					'</div>');
		$('body').append($backTop);
		
		$backTop.click(function(){
			$("html, body").animate({
				scrollTop: 0
			}, 120);
		});

		var timmer = null;
		$(window).bind("scroll",function() {
            var d = $(document).scrollTop(),
            e = $(window).height();
            0 < d ? $backTop.css("bottom", "100px") : $backTop.css("bottom", "-90px");
			clearTimeout(timmer);
			timmer = setTimeout(function() {
                clearTimeout(timmer)
            },100);
	   });
	}
	
}
var jiaolianyuan = new jiaolianyuan();

});