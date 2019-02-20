// 标签的索引

window.onload=function(){
  new uploadPreview({ UpBtn: "upload", DivShow: "imgdiv", ImgShow: "pic" });
      function $(id){
  return typeof id==='string'?document.getElementById(id):id;
}
  var index=0;
  var timer=null;
  // var a = document.getElementById("main-left");
  // var b= document.getElementsByName("left-tab");
  var lis = $('main-left') .getElementsByTagName('li');
//   alert(lis.length);
   var divs =$('left-tab') .getElementsByTagName('article');
  // var aaa =document.getElementById('content-list');
  //   var bbb=aaa.childNode("img");
//       alert(divs.length);
if(lis.length!=divs.length) return;

  // 遍历所有的页签
  for(var i=0;i<lis.length;i++){
    lis[i].id=i;
    lis[i].onclick=function(){
      // 用that这个变量来引用当前滑过的li
      var that=this;
    
     // bbb[i].setAttribute('src','coach-center-img/'+i+'.png')
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
  };
  var a= document.getElementById("class-list");
  var b= document.getElementById("stu-list");
  var aLi= a.getElementsByTagName('li');
  var  aDiv=b.getElementsByTagName('ul');
  //   var aLi = $('class-list').getElementsByTagName('li');
  // // alert(lis.length);
  //  var aDiv =$('stu-list').getElementsByTagName('ul');
      // alert(aDiv.length);
  if(aLi.length!=aDiv.length) return;

  // 遍历所有的页签
  for(var i=0;i<aLi.length;i++){
    aLi[i].id=i;
    aLi[i].onclick=function(){
      // 用that这个变量来引用当前滑过的li
      var that=this;
      // 如果存在准备执行的定时器，立刻清除，只有当前停留时间大于500ms时才开始执行
      if(timer){
        clearTimeout(timer);
        timer=null;
      }
      // 延迟半秒执行
      timer=window.setTimeout(function(){
        for(var j=0;j<aLi.length;j++){
          aLi[j].className='';
          aDiv[j].style.display='none';
        }
        aLi[that.id].className='active';
        aDiv[that.id].style.display='block';

      },100);
    }

  }

}