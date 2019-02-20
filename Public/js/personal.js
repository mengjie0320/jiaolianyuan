window.onload = function(){
   	var searchContent = $("#searchContent").val();
      
  $.ajax({
      contentType:"application/json",
      type : "get",
      url : "searchTitleId",
      dataType : "json",
      cache : "false",
      async : true,
      success : function(datac){
      	
                 if(datac.ret == 200)
                  {
        for (var i=0;i<datac.data.length;i++) 
        {
                        $("#title"+datac.data[i]['referid']).append("<img class='little_circle' src='/jiaolianyuan/Public/images/student-center-img/new_message.png'/>");
          }
          }
      },
      error: function(datac){
        alert("出错啦")
      }
     });    
     
     var oUl = document.getElementsByClassName('content_list')[0];
     var oLi = oUl.getElementsByTagName('li');
     var oNews = document.getElementById('news');
     var oSet = document.getElementById('set');
     
     var num = 0;
     
     oLi[0].className = 'select';
     

    function clearClassName(){
		for(var i=0; i<oLi.length; i++){
			oLi[i].className = '';
		}
	}
    oLi[2].onclick = function(){
     	clearClassName();
     	this.className = 'select';
     	oSet.style.display = 'block';
     	oNews.style.display = 'none';
     }
    oLi[0].onclick = function(){
     	clearClassName();
     	this.className = 'select';
     	oSet.style.display = 'none';
     	oNews.style.display = 'block';
     }
};

 var modal_form = document.getElementById('modal_form');
 var mask = document.getElementById('mask');
     function show()
     {
         modal_form.style.display = "block";
         mask.style.display = "block";
     
     }
     function hide()
     {
         modal_form.style.display = "none";
        mask.style.display = "none";
     }
$(function(){
	$("#change_password").click(function(){
		$("#mask").css({
			display:"block",height:$(document).height()
		});
	})
})