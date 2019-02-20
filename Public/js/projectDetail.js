
window.onload=function(){
	var Oitem = document.getElementById('project_detail');
	var Oques = document.getElementById('ques');
	var Oitems = document.getElementById('itemDetail');
	var Ocoach =  document.getElementById('coach');
	
	Ocoach.onclick = function(){

		 $(this).addClass("select");
		$("#itemDetail").removeClass("select");
		 
		 
		Oques.style.display = 'block';
		Oitem.style.display = 'none';
		
//	    var Oitem = document.getElementById('item_content_bg');
		
	};
	Oitems.onclick = function(){

         $(this).addClass("select");
		 $("#coach").removeClass("select");
		 
         
		Oitem.style.display = 'block';
		Oques.style.display = 'none';
//		document.getElementById("coach").setAttribute("class",select );
        
	};
	
	var Ofile = document.getElementById('file');
	var Osubmit = document.getElementById('submit');

	Ofile.onclick = function(){
		Osubmit.style.display = "block";
		Ofile.style.opacity = "1";
	}
};
