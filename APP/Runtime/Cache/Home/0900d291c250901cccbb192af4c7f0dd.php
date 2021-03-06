<?php if (!defined('THINK_PATH')) exit();?><html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>教练缘--咨询室</title>
  <script type="text/javascript">
  //WebSocket = null;
  </script>
  <link href="/jiaolianyuan/Public/images/public/logo.ico" rel="icon"/>
  <link href="/jiaolianyuan/Public/CSS/bootstrap.min.css" rel="stylesheet">
  <link href="/jiaolianyuan/Public/CSS/style2.css" rel="stylesheet">
  <!-- Include these three JS files: -->
  <script type="text/javascript" src="/jiaolianyuan/Public/js/swfobject.js"></script>
  <script type="text/javascript" src="/jiaolianyuan/Public/js/web_socket.js"></script>
  <script type="text/javascript" src="/jiaolianyuan/Public/js/jquery.min.js"></script>
  <script type="text/javascript">
    if (typeof console == "undefined") {    this.console = { log: function (msg) {  } };}
    WEB_SOCKET_SWF_LOCATION = "/jiaolianyuan/Public/swf/WebSocketMain.swf";
    WEB_SOCKET_DEBUG = true;
    var ws, client_list={};
    var name = '<?php echo ($myName); ?>';
    var targetName = '<?php echo ($targetName); ?>';
    var audio_data;
    
    // 连接服务端
    function connect() {
       // 创建websocket
       ws = new WebSocket("ws://"+document.domain+":7272");
       // 当socket连接打开时，输入用户名
       ws.onopen = onopen;
       // 当有消息时根据消息类型显示不同信息
       ws.onmessage = onmessage; 
       ws.onclose = function() {
    	  console.log("连接关闭，定时重连");
          connect();
       };
       ws.onerror = function() {
     	  console.log("出现错误");
       };
    }

    // 连接建立时发送登录信息
    function onopen()
    {
        // 登录
        var login_data = '{"type":"login","client_name":"'+name.replace(/"/g, '\"')+'","room_id":"<?php echo isset($_GET['room_id']) ? $_GET['room_id'] : $first_room_id?>"}';
        console.log("websocket握手成功，发送登录数据:"+login_data);
        ws.send(login_data);
    }

    // 服务端发来消息时
    function onmessage(e)
    {
        var data = eval("("+e.data+")");
        switch(data['type']){
            // 服务端ping客户端
            case 'ping':
                ws.send('{"type":"pong"}');
                break;;
            // 登录 更新用户列表
            case 'login':
                //{"type":"login","client_id":xxx,"client_name":"xxx","client_list":"[...]","time":"xxx"}
                say(data['client_id'], data['client_name'],  data['client_name']+' 加入了聊天室', data['time']);
                if(data['client_list'])
                {
                    client_list = data['client_list'];
                }
                else
                {
                    client_list[data['client_id']] = data['client_name']; 
                }
                flush_client_list();
                console.log(data['client_name']+"登录成功");
                break;
      			// 接收语音
      		case 'audio':
      			    speak(data['from_client_id'], data['from_client_name'], data['content'], data['time']);
                break;
            // 接收图片
            case 'image':
                showImage(data['from_client_id'], data['from_client_name'], data['content'], data['time']);
                break;
            // 发言
            case 'say':
                //{"type":"say","from_client_id":xxx,"to_client_id":"all/client_id","content":"xxx","time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['content'], data['time']);
                break;
            // 用户退出 更新用户列表
            case 'logout':
                //{"type":"logout","client_id":xxx,"time":"xxx"}
                say(data['from_client_id'], data['from_client_name'], data['from_client_name']+' 退出了', data['time']);
                delete client_list[data['from_client_id']];
                flush_client_list();
        }
    }

    // 提交对话
    function onSubmit() {
      var input = document.getElementById("textarea");
      var word = input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r');
      var to_client_id = $("#client_list option:selected").attr("value");
      var to_client_name = $("#client_list option:selected").text();
      if(to_client_id == 'all'){
        to_client_name = 'all';
      }
      //传递JSON数据时，传to_client_id是为了验证对方是否在线（不在线则to_client_id的值为offline）
      $.ajax({
	        type: "POST",
	        url: "/jiaolianyuan/index.php/Home/Index2/ajax",
	        data: {"type":0, "word":word, "room_id": <?php echo isset($_GET['room_id']) ? $_GET['room_id'] : $first_room_id?>, "userName": name, "targetName": to_client_name, "to_client_id": to_client_id},
	        dataType: "text",
	        success: function(data){
            if(to_client_id != 'offline'){
                ws.send('{"type":"say","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+word+'"}');
            }
            else{
            	say(0,name,"<b>你对"+targetName+"说: </b>"+word,"<?php echo date('Y-m-d H-i-s'); ?>")
            }
	        }
	  });
      input.value = "";
      input.focus();
    }

    // 刷新用户列表框
    function flush_client_list(){
      var is_coach_online = false;
      var coach_client_id = null;
    	var userlist_window = $("#userlist");
    	var client_list_select = $("#client_list");
    	userlist_window.empty();
    	client_list_select.empty();
    	userlist_window.append('<h4>在线用户</h4><ul>');
    	client_list_select.append('<option value="all" id="cli_all">所有人</option>');
      for(var p in client_list){
          userlist_window.append('<li id="'+p+'">'+client_list[p]+'</li>');
          if(client_list[p] == targetName){
              is_coach_online = true;
              coach_client_id = p;
          }
      }
      if(is_coach_online){  //判断教练是否在线，不在线则根据value="offline"省略ws.send()，以免产生异常
         client_list_select.append('<option value="'+coach_client_id+'">'+targetName+'</option>');
         $("#tip").empty();
      }else{
         client_list_select.append('<option value="offline" id="cli_teacher">'+targetName+'</option>');
         $("#tip").append("提示：当前教练不在线，可对教练留言，留言内容由双方查看历史记录获得");
      }
     
    	$("#client_list").val(select_client_id);
    	userlist_window.append('</ul>');
    }

    // 发言
    function say(from_client_id, from_client_name, content, time){
    	$("#dialog").append('<div class="speech_item"><img src="/jiaolianyuan/Public/images/<?php echo ($face); ?>" class="user_icon" /> '+from_client_name+' <br> '+time+'<div style="clear:both;"></div><p class="triangle-isosceles top">'+content+'</p> </div>');
    	dialog.scrollTop = dialog.scrollHeight;
    }

    // 接收语音
    function speak(from_client_id, from_client_name, content, time){
      var p;  //一旦content包含了前缀“你对谁说”，则需要将content的前缀截取出来
      if(content.indexOf("<b>") != -1){
        var prefix = content.substring(0, content.indexOf("Public"));
        p = $("<p class='triangle-isosceles top'>"+prefix+"</p>");
      }else{
        p = $("<p class='triangle-isosceles top'></p>");
      }
      var newAudio = document.createElement("audio");
      newAudio.controls = "controls";
      p.append(newAudio);
      var item = $("<div class='speech_item'></div>");
      item.append($("<img src='/jiaolianyuan/Public/images/<?php echo ($targetface); ?>' class='user_icon' />"), document.createTextNode(from_client_name), $("<br>"), document.createTextNode(time), $("<div style='clear:both;'></div>"), p);
      $("#dialog").append(item);
      content = content.substring(content.indexOf("Public"));
      newAudio.src = content;
      dialog.scrollTop = dialog.scrollHeight;
    }

    // 接收图片
    function showImage(from_client_id, from_client_name, content, time){
      var p;  //一旦content包含了前缀“你对谁说”，则需要将content的前缀截取出来
      if(content.indexOf("<b>") != -1){
        var prefix = content.substring(0, content.indexOf("Public"));
        p = $("<p class='triangle-isosceles top'>"+prefix+"</p>");
      }else{
        p = $("<p class='triangle-isosceles top'></p>");
      }
      content = content.substring(content.indexOf("Public"));
      var newImg = document.createElement("img");
      newImg.src = content;
      newImg.style.width = "300px";
      p.append(newImg);
      var item = $("<div class='speech_item'></div>");
      item.append($("<img src='/jiaolianyuan/Public/images/<?php echo ($targetface); ?>' class='user_icon' />"), document.createTextNode(from_client_name), $("<br>"), document.createTextNode(time), $("<div style='clear:both;'></div>"), p);
      $("#dialog").append(item);
      dialog.scrollTop = dialog.scrollHeight;
    }

    $(function(){
      select_client_id = 'all';
	    $("#client_list").change(function(){
	         select_client_id = $("#client_list option:selected").attr("value");
	    });
    });

	  //以下是录音部分的实现

    var AudioContext=AudioContext||webkitAudioContext;
    var context=new AudioContext;
    
    //调整兼容
    navigator.getUserMedia= 
      navigator.getUserMedia||
      navigator.webkitGetUserMedia||
      navigator.mozGetUserMedia;
    //请求麦克风
    navigator.getUserMedia({audio:true},function(e){
        var p;
        //从麦克风的输入流创建源节点
        var stream=context.createMediaStreamSource(e);
        //用于录音的processor节点
        var recorder=context.createScriptProcessor(1024,1,0);
        recorder.onaudioprocess=function(e){
            if(record.value=="停止")audio_data.push(e.inputBuffer.getChannelData(0));
        };
        var oRecord = document.getElementById("record");
        var oUpload = document.getElementById("upload");
        //录音/停止 按钮点击动作
        record.onclick=function(){
            if(record.value=="录音"){
                oRecord.style.backgroundPosition="0px -26px";
                return audio_data=[],stream.connect(recorder),this.value="停止";     
            }           
            if(record.value=="停止"){
            		oRecord.style.backgroundPosition="2px 2px";
            		oUpload.style.display = "inline-block";
                return stream.disconnect(),this.value="录音";
            }
            	
                
        };
          
        //保存
/*        upload.onclick=function(){
        		oUpload.style.display = "none";  
        		
            var frequency=context.sampleRate; //采样频率
            var pointSize=16; //采样点大小
            var channelNumber=1; //声道数量
            var blockSize=channelNumber*pointSize/8; //采样块大小
            var wave=[]; //数据
            for(var i=0;i<audio_data.length;i++){
                for(var j=0;j<audio_data[i].length;j++){
                    wave.push(audio_data[i][j]*0x8000|0);
                }
            }
            var length=wave.length*pointSize/8; //数据长度
            var buffer=new Uint8Array(length+44); //wav文件数据
            var view=new DataView(buffer.buffer); //数据视图
            buffer.set(new Uint8Array([0x52,0x49,0x46,0x46])); //"RIFF"
            view.setUint32(4,audio_data.length+44,true); //总长度
            buffer.set(new Uint8Array([0x57,0x41,0x56,0x45]),8); //"WAVE"
            buffer.set(new Uint8Array([0x66,0x6D,0x74,0x20]),12); //"fmt "
            view.setUint32(16,16,true); //WAV头大小
            view.setUint16(20,1,true); //编码方式
            view.setUint16(22,1,true); //声道数量
            view.setUint32(24,frequency,true); //采样频率
            view.setUint32(28,frequency*blockSize,true); //每秒字节数
            view.setUint16(32,blockSize,true); //采样块大小
            view.setUint16(34,pointSize,true); //采样点大小
            buffer.set(new Uint8Array([0x64,0x61,0x74,0x61]),36); //"audio_data"
            view.setUint32(40,length,true); //数据长度
            buffer.set(new Uint8Array(new Int16Array(wave).buffer),44); //数据
            //打开文件
            var blob=new Blob([buffer],{type:"audio/wav"});
            var filereader = new FileReader();
            
            filereader.onload = function(event) {
                var audio_content;
                audio_content = event.target.result;
                var pos = audio_content.indexOf("4")+2;
                audio_content = audio_content.substring(pos, audio_content.length - pos);//去掉Base64:开头的标识字符
                var to_client_id = $("#client_list option:selected").attr("value");
                var to_client_name = $("#client_list option:selected").text();
                if(to_client_id == 'all'){
                  to_client_name = 'all';
                }
      
                $.ajax({
                    type: "POST",
                    url: "/jiaolianyuan/index.php/Home/Index2/ajax",
                    data: {"type":2, "audio":audio_content, "room_id": <?php echo isset($_GET['room_id']) ? $_GET['room_id'] : $first_room_id?>, "userName": name, "targetName": to_client_name, "to_client_id": to_client_id},
                    dataType: "text",
                    success: function(data){
                        if(to_client_id != 'offline'){
                        	  data = data.replace("\"","").replace("\"","");
                            var record_data = '{"type":"audio","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+data+'"}';
                            ws.send(record_data);
                        }
                        else{
            	           speak(0,name,"<b>你对"+targetName+"说: </b>"+word,"<?php echo date('Y-m-d H-i-s'); ?>")
                      }
                    }
                });
            };

            filereader.onerror = function(event) {
                console.error("File could not be read! Code " + event.target.error.code);
            };
            
            filereader.readAsDataURL(blob);
        };
    },function(e){
      console.log("请求麦克风失败");
    });
	*/
		//获取选择图片按钮
		var Ofile =  document.getElementsByClassName("file");
		var OuploadImage = document.getElementsByClassName("uploadImage");
		function showButton(){
			Ofile[0].style.backgroundPosition="2px -88px";
			OuploadImage[0].style.display = "inline-block";
		}

    var image = '';
    function selectImage(file){
        if(!file.files || !file.files[0]){
            return;
        }
        var reader = new FileReader();
        reader.onload = function(evt){
            //document.getElementById('image').src = evt.target.result;
            image = evt.target.result;
            var pos = image.indexOf("4")+2;
            image = image.substring(pos, image.length - pos);//去掉Base64:开头的标识字符
        }
        reader.readAsDataURL(file.files[0]);
    }

    function uploadImage(){
    	
        var to_client_id = $("#client_list option:selected").attr("value");
        var to_client_name = $("#client_list option:selected").text();
       //点击后让按钮消失
       	OuploadImage[0].style.display = "none";
       	Ofile[0].style.backgroundPosition="2px -58px";
       	
       	OuploadImage[0].onmouseover = function(){
       			Ofile[0].style.backgroundPosition="2px -88px";
       		}
       	
        if(to_client_id == 'all'){
          to_client_name = 'all';
        }
        $.ajax({
            type:'POST',
            url: '/jiaolianyuan/index.php/Home/Index2/ajax',
            data: {"type":1, "image": image, "room_id": <?php echo isset($_GET['room_id']) ? $_GET['room_id'] : $first_room_id?>, "userName": name, "targetName": to_client_name, "to_client_id": to_client_id},
            dataType: 'text',
            success: function(data){
                if(to_client_id != 'offline'){
                	  data = data.replace("\"","").replace("\"","");
                    var image_data = '{"type":"image","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+data+'"}';
                    ws.send(image_data);
                }
                else{
            	     showImage(0,name,"<b>你对"+targetName+"说: </b>"+word,"<?php echo date('Y-m-d H-i-s'); ?>")
                 }
            },
            error: function(err){
                alert('网络故障');
            }
        });
    }

    function showHistory(){
        $.ajax({
            type:'POST',
            url: '/jiaolianyuan/index.php/Home/Index2/ajax_history',
            data: {"room_id": <?php echo isset($_GET['room_id']) ? $_GET['room_id'] : $first_room_id?>, "identity": "student"},
            dataType: 'text',
            success: function(data){
                var history = eval(data);
                $("#dialog").empty();
                for(var i=0;i<history.length;i++){
                    if(history[i]['username'] == name && history[i]['targetname'] == targetName){
                        history[i]['content'] = "<b>你对"+targetName+"说：</b>" + history[i]['content'];
                    }
                    else if(history[i]['username'] == targetName && history[i]['targetname'] == name){
                        history[i]['content'] = "<b>对你说：</b>" + history[i]['content'];
                    }
                    if(history[i]['username'] == name || history[i]['targetname'] == 'all' || history[i]['targetname'] == name){
                        switch(history[i]['type']){
                            case "0":
                                say(0, history[i]['username'], history[i]['content'], history[i]['time']);
                                break;
                            case "1":
                                showImage(0, history[i]['username'], history[i]['content'], history[i]['time']);
                                break;
                            case "2":
                                speak(0, history[i]['username'], history[i]['content'], history[i]['time']);
                                break;
                        }
                    }
                }
            },
            error: function(err){
                alert('网络故障');
            }
        });
        
 
    }
    	

  </script>
</head>
<body onload="connect();">
    <div class="container">
	    <div class="row clearfix">
	      <div class="col-md-1 column"></div>
	        <div class="col-md-6 column">
	          <div class="thumbnail">
	           	<img src="/jiaolianyuan/Public/images/public/logo.png" alt="教练缘" title="教练缘"/>
	            <div class="caption" id="dialog"></div>
	            <div id="msg_end" ></div>       
	          </div>
	          <form onsubmit="onSubmit(); return false;">
	           		<div id="tip"></div>
	                <select id="client_list">
                    <option value="all">所有人</option>
                  </select>
                  <!--<input value="录音" type="button" id="record"/>
                  <input value="发送录音" type="button" id="upload" />-->
                  <span class="file"><input type="file" onchange="selectImage(this);" class="file" onclick="showButton()"></span>
                  <input value="发送图片" type="button" onclick="uploadImage()" class="uploadImage"/>
                  <input value="查看所有历史记录" type="button" onclick="showHistory()" class="showHistory"/>
                  <textarea class="textarea" id="textarea" autofocus="autofocus"></textarea><!--内容输入框-->
                  <div class="say-btn">
                  	<input type="submit" class="btn btn-default" value="发送" /><!--发送按钮-->
                  </div>
            </form>
            <div>
              <b>房间列表:</b>（当前在<?php echo ($targetName); ?>的房间）
              <?php if(is_array($allow_room_list)): foreach($allow_room_list as $key=>$vo): ?><!--&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?id=<?php echo ($id); ?>&identity=<?php echo ($identity); ?>&room_id=<?php echo ($vo["roomid"]); ?>"><?php echo ($vo["teachername"]); ?></a>-->
                  <a href="/jiaolianyuan/index.php/Home/Index2/index2/room_id/<?php echo ($vo["roomid"]); ?>"><?php echo ($vo["teachername"]); ?></a><?php endforeach; endif; ?>
            </div>
	        </div>
	        <!--在线用户列表-->
	        <div class="col-md-3 column">
	          <div class="thumbnail">
	          	<a href="/jiaolianyuan/index.php/Home/Student/student.html"></a>
              <div class="caption" id="userlist"></div>
            </div>
	        </div>
	    </div>
    </div>
</body>
</html>