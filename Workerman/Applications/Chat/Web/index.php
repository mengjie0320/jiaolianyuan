<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>workerman-chat PHP聊天室 Websocket(HTLM5/Flash)+PHP多进程socket实时推送技术</title>
  <script type="text/javascript">
  //WebSocket = null;
  </script>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <!-- Include these three JS files: -->
  <script type="text/javascript" src="/js/swfobject.js"></script>
  <script type="text/javascript" src="/js/web_socket.js"></script>
  <script type="text/javascript" src="/js/jquery.min.js"></script>

  <script type="text/javascript">
    if (typeof console == "undefined") {    this.console = { log: function (msg) {  } };}
    WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
    WEB_SOCKET_DEBUG = true;
    var ws, name, client_list={};
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
        if(!name)
        {
            show_prompt();
        }
        // 登录
        var login_data = '{"type":"login","client_name":"'+name.replace(/"/g, '\\"')+'","room_id":"<?php echo isset($_GET['room_id']) ? $_GET['room_id'] : 1?>"}';
        console.log("websocket握手成功，发送登录数据:"+login_data);
        ws.send(login_data);
    }

    // 服务端发来消息时
    function onmessage(e)
    {
        console.log(e.data);
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

    // 输入姓名
    function show_prompt(){  
        name = prompt('输入你的名字：', '');
        if(!name || name=='null'){  
            name = '游客';
        }
    }

    // 提交对话
    function onSubmit() {
      var input = document.getElementById("textarea");
      var to_client_id = $("#client_list option:selected").attr("value");
      var to_client_name = $("#client_list option:selected").text();
      ws.send('{"type":"say","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+input.value.replace(/"/g, '\\"').replace(/\n/g,'\\n').replace(/\r/g, '\\r')+'"}');
      input.value = "";
      input.focus();
    }

    // 刷新用户列表框
    function flush_client_list(){
    	var userlist_window = $("#userlist");
    	var client_list_slelect = $("#client_list");
    	userlist_window.empty();
    	client_list_slelect.empty();
    	userlist_window.append('<h4>在线用户</h4><ul>');
    	client_list_slelect.append('<option value="all" id="cli_all">所有人</option>');
    	for(var p in client_list){
            userlist_window.append('<li id="'+p+'">'+client_list[p]+'</li>');
            client_list_slelect.append('<option value="'+p+'">'+client_list[p]+'</option>');
        }
    	$("#client_list").val(select_client_id);
    	userlist_window.append('</ul>');
    }

    // 发言
    function say(from_client_id, from_client_name, content, time){
    	$("#dialog").append('<div class="speech_item"><img src="http://lorempixel.com/38/38/?'+from_client_id+'" class="user_icon" /> '+from_client_name+' <br> '+time+'<div style="clear:both;"></div><p class="triangle-isosceles top">'+content+'</p> </div>');
    }

    // 接收语音
    function speak(from_client_id, from_client_name, content, time){
      var newAudio = document.createElement("audio");
      newAudio.controls = "controls";
      var p = $("<p class='triangle-isosceles top'></p>");
      p.append(newAudio);
      var item = $("<div class='speech_item'></div>");
      item.append($("<img src='http://lorempixel.com/38/38/?"+from_client_id+"' class='user_icon' />"), document.createTextNode(from_client_name), $("<br>"), document.createTextNode(time), $("<div style='clear:both;'></div>"), p);
      $("#dialog").append(item);
      newAudio.src = content;
    }

    // 接收图片
    function showImage(from_client_id, from_client_name, content, time){
      var newImg = document.createElement("img");
      newImg.src = content;
      newImg.style.width = "300px";
      var p = $("<p class='triangle-isosceles top'></p>");
      p.append(newImg);
      var item = $("<div class='speech_item'></div>");
      item.append($("<img src='http://lorempixel.com/38/38/?"+from_client_id+"' class='user_icon' />"), document.createTextNode(from_client_name), $("<br>"), document.createTextNode(time), $("<div style='clear:both;'></div>"), p);
      $("#dialog").append(item);
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
        //录音/停止 按钮点击动作
        record.onclick=function(){
            if(record.value=="录音")
                return audio_data=[],stream.connect(recorder),this.value="停止";
            if(record.value=="停止")
                return stream.disconnect(),this.value="录音";
        };
          
        //保存
        upload.onclick=function(){
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
                console.log("File contents: " + audio_content);

                $.ajax({
                    type: "POST",
                    url: "ajax_audio.php",
                    data: {"audio":audio_content},
                    dataType: "text",
                    success: function(data){
                        var record_data = '{"type":"audio","client_name":"'+name.replace(/"/g, '\\"')+'","room_id":"<?php echo isset($_GET['room_id']) ? $_GET['room_id'] : 1?>","to_client_id":"all","content":"'+data+'"}';
                        ws.send(record_data);
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
        $.ajax({
            type:'POST',
            url: 'ajax_image.php',
            data: {"image": image},
            dataType: 'text',
            success: function(data){
                var image_data = '{"type":"image","client_name":"'+name.replace(/"/g, '\\"')+'","room_id":"<?php echo isset($_GET['room_id']) ? $_GET['room_id'] : 1?>","to_client_id":"all","content":"'+data+'"}';
                ws.send(image_data);
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
	        <div class="col-md-1 column">
	        </div>
	        <div class="col-md-6 column">
	           <div class="thumbnail">
	               <div class="caption" id="dialog" style="height:600px;overflow:scroll"></div>
	           </div>
	           <form onsubmit="onSubmit(); return false;">
	                <select style="margin-bottom:8px" id="client_list">
                        <option value="all">所有人</option>
                  </select>
                  <input value="录音" type="button" id="record" />
                  <input value="提交录音" type="button" id="upload" />
                  <input type="file" onchange="selectImage(this);"/>
                  <input value="上传图片" type="button" onclick="uploadImage()"/>

                  <textarea class="textarea thumbnail" id="textarea"></textarea>
                  <div class="say-btn"><input type="submit" class="btn btn-default" value="发表" /></div>
               </form>
               <div>
               &nbsp;&nbsp;&nbsp;&nbsp;<b>房间列表:</b>（当前在&nbsp;房间<?php echo isset($_GET['room_id'])&&intval($_GET['room_id'])>0 ? intval($_GET['room_id']):1; ?>）<br>
               &nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=1">房间1</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=2">房间2</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=3">房间3</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/?room_id=4">房间4</a>
               <br><br>
               </div>
               <p class="cp">PHP多进程+Websocket(HTML5/Flash)+PHP Socket实时推送技术&nbsp;&nbsp;&nbsp;&nbsp;Powered by <a href="http://www.workerman.net/workerman-chat" target="_blank">workerman-chat</a></p>
	        </div>
	        <div class="col-md-3 column">
	           <div class="thumbnail">
                   <div class="caption" id="userlist"></div>
               </div>
               <a href="http://workerman.net:8383" target="_blank"><img style="width:252px;margin-left:5px;" src="/img/workerman-todpole.png"></a>
	        </div>
	    </div>
    </div>

    <script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7b1919221e89d2aa5711e4deb935debd' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>
