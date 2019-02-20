 	window.onload = function(){

	var Oitem = document.getElementById('item_content_bg');
	var Oques = document.getElementById('ques');
	var Oitems = document.getElementById('items');
	var Ocoach =  document.getElementById('coach');
	
	Ocoach.onclick = function(){
		 $(this).addClass("select");
		$("#items").removeClass("select");
		 
		 
		Oques.style.display = 'block';
		Oitem.style.display = 'none';
		
		
	};
	Oitems.onclick = function(){

         $(this).addClass("select");
		 $("#coach").removeClass("select");
		 
         
		Oitem.style.display = 'block';
		Oques.style.display = 'none';
	};
      
      //品牌翻转
	var turn = function(target,time,opts){
	    target.find('a').hover(function(){
	        $(this).find('img').stop().animate(opts[0],time,function(){
	            $(this).hide().next().show();
	            $(this).next().animate(opts[1],time);
	        });
	    },function(){
	        $(this).find('.info').animate(opts[0],time,function(){
	            $(this).hide().prev().show();
	            $(this).prev().animate(opts[1],time);
	        });
	    });
	}
	var verticalOpts = [{'width':0},{'width':'162px'}];
	turn($('#vertical'),100,verticalOpts);
	
 	};
