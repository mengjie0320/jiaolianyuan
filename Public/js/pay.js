
var modal_form = document.getElementById('modal_form');
var mask = document.getElementById('mask');
     function show()
     {
         modal_form.style.display = "block";
         mask.style.display = "block";  
        var left = ($(window).width() - $('#modal_form').width())/2;   
        var scrollTop = $(document).scrollTop();    
        var scrollLeft = $(document).scrollLeft();   
        var sTop = document.documentElement.scrollTop || document.body.scrollTop;
		var cHeight= document.documentElement.clientHeight || document.body.clientHeight;
		var mid = (cHeight - modal_form.offsetHeight) / 4; 
		if(navigator.appVersion.indexOf("MSIE 6")> -1){			//解决了在IE6的兼容性
			$('#modal_form').css( { position : 'absolute', 'top' :parseInt(sTop + mid) , left : left + scrollLeft } );
		}else{
			 $('#modal_form').css( { position : 'absolute', 'top' : mid , left : left + scrollLeft } );
		}     
     }
     
     function hide()
     {
        modal_form.style.display = "none";
        mask.style.display = "none";
     }
   
$(function(){
$("#pay").click(function(){
	$("#mask").css({
		display:"block",height:$(document).height()
		});
	})
})
