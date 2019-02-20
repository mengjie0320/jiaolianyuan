$(function(){
	$('#choose_list').find('li').click(function(){
		$(this).addClass('active').siblings('li').removeClass('active');
	})
})

$(function(){
	$(".course_list ul li").hover(function(){
	var	classId = $(this).attr('id');
$.ajax({
		contentType:"application/json",
		type : "get",
		url : "/jiaolianyuan/Home/Index/projectNum",
		data : {"classId":classId},
		dataType : "json",
		cache : "false",
		async : true,
		success : function(datac){
         if(datac.ret == 200)
          {
            $('.hover_title').detach();
			for (var i=0;i<datac.data.length;i++) 
			{
                $(".course_all").append("<div class='hover_title'><span>共<b style='color: #94373D;'>"+datac.data[i]+"</b>项目</span></div>");
		    }
	      }
           else
		   {
		   	alert(datac.data);
           }
		},
		error: function(datac){
			alert("出错啦")
			}
	    });
	  });
 })
				