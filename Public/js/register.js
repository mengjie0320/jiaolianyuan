
window.onload = function(){
    //发送手机验证码
    $("#codes-btn").on("click",function(e){
            e.preventDefault();
            var _this=$(this);
            time(_this);
    });
};
    function time(o) {
    	timeMins(o);
    //发送短信验证码
    	var phoneNo = document.getElementById("register-phone").value;
    	var url = "sendPhoneMessage?phoneNo="+phoneNo;
        $.post(url,function(data){
            if(data == "200"){
                $("#showText").show();
                $("#mes-codes").attr("disabled",false);
                $("#codes-btn").attr("disabled",true);
                $(o).css("color","#fff").attr("onclick","");                                        
            }else{
                alert("短信发送失败!");
            }
        });
    }
    //时间倒计时
    var wait=60,timeOut;
    function timeMins(o) {
         if (wait == 0) {
             $("#showText").hide();
             $(o).html("重发短信验证码").css("color","#09f").attr("onclick","time(this)");
             clearTimeout(timeOut);
             wait = 60;
              $("#codes-btn").attr("disabled",false);
    } else {
        wait--;
        timeOut=setTimeout(function(){
                timeMins(o);
        },1000);
        $("#showTime").html(wait+"s");
    }
}
    
//离开文本框时检查手机号是否被注册
function checkPhone(phoneNo)
{
   var url = "checkPhone?phoneNo="+phoneNo;
   document.getElementById("checkRemind").value="";
   getJson(url,function (result) {
   result = JSON.parse(result); 
   document.getElementById("checkRemind").innerHTML = result['data'];  
   })
}; 

//离开文本框时检查真实姓名(即用户名)是否被注册
function checkRealName(realName)
{
   var url = "checkRealName?realName="+realName;
   document.getElementById("checkRealName").value="";
   getJson(url,function (result) {
   result = JSON.parse(result); 
   document.getElementById("checkRealName").innerHTML = result['data'];  
   })
};

//离开文本框时检查手机验证码是否正确
 function checkPhoneCode(phoneCode)
 	{
       var url = "checkPhoneCode?phoneCode="+phoneCode;
       document.getElementById("checkPhoneCode").value="";
       getJson(url,function (result) {
       result = JSON.parse(result); 
       document.getElementById("checkPhoneCode").innerHTML = result['data'];  
       })
 	} 