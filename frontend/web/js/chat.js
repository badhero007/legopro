var webim = {
    'server' : '123.57.36.144'
};
var ws = {};
var client_id = 0;
var userlist = {};
var GET = getRequest();

$(document).ready(function () {
    //使用原生WebSocket
    if (window.WebSocket || window.MozWebSocket)
    {
        ws = new WebSocket(webim.server);
    }
    listenEvent();
});

function listenEvent() {
    /**
     * 连接建立时触发
     */
    ws.onopen = function (e) {
        //连接成功
        console.log("connect webim server success.");
        //发送登录信息
        msg = new Object();
        msg.channel = 'admin';
        msg.uid = globalInfo.uid;
        msg.token = globalInfo.token;
        msg.nickname = globalInfo.nickname;
        msg.cmd = 'admin:login';
        console.log(msg);
        ws.send(JSON.stringify(msg));
        console.log('msg send.');
    };

    //有消息到来时触发
    ws.onmessage = function (e) {
        var message = JSON.parse(e.data);
        var cmd = message.cmd;
        console.log(message);
        if (cmd == 'admin:login')
        {
            client_id = message.data.fd;

            //也可以在服务端 登录事件中直接调用相关操作
            msg = new Object();
            msg.channel = 'admin';
            msg.uid = globalInfo.uid;
            msg.token = globalInfo.token;
            msg.nickname = globalInfo.nickname;
            msg.cmd = 'test:login';
            console.log(msg);
            ws.send(JSON.stringify(msg));
            console.log('msg send.');
        }
        else if (cmd == 'test:getOnlineList')
        {
            handleOnlineList(message.data);
        }
        else if (cmd == 'test:newUser')
        {
            showNewUser(message.data);
        }
        else if (cmd == 'test:newMsg')
        {
            showMsg(message.data,'new');
        }
        else if (cmd == 'test:historyMsg')
        {
            loadHistoryMsg(message.data);
        }
        else if (cmd == 'test:logout')
        {
            hideUser(message.data);
        } else {
            console.log("message handler not found.");
        }
    };

    /**
     * 连接关闭事件
     */
    ws.onclose = function (e) {
        console.log("onclose:" + e.data);
        console.log(e);
    };

    /**
     * 异常事件
     */
    ws.onerror = function (e) {
        console.log("onerror: " + e.data);
        console.log(e);
    };
}

document.onkeydown = function (e) {
    var ev = document.all ? window.event : e;
    if (ev.keyCode == 13) {
        $("#sendMsgBtn").trigger("click");
        return false;
    } else {
        return true;
    }
};

$("#sendMsgBtn").click(function(){
    msg = new Object();
    msg.channel = 'admin';
    msg.uid = globalInfo.uid;
    msg.token = globalInfo.token;
    msg.nickname = globalInfo.nickname;
    msg.cmd = 'admin:sendMsg';

    msg.from = client_id;
    msg.to = $("#online-admin").val();
    msg.to_uid = userlist[msg.to];
    msg.content = $("#msg_content").val();

    console.log(msg);
    ws.send(JSON.stringify(msg));
    console.log('msg send.');
});

function showNewUser(dataObj) {
    if (!userlist[dataObj.fd]) {
        userlist[dataObj.fd] = dataObj.uid;
    }
    $("#online-admin").append('<option value="'+dataObj.fd+'" id="user_'+dataObj.fd+'">'+dataObj.nickname+"["+dataObj.fd+']</option>');
}

function handleOnlineList(dataObj) {
    for (var t_fd in dataObj) {
        if (dataObj.hasOwnProperty(t_fd)) {
            if (dataObj[t_fd]['fd'] != client_id) {
                showNewUser(dataObj[t_fd]);
            }
        }
    }
}

function showMsg(dataObj,msgType) {

    var t_html = '<li><a href="javascript:;">\
        <div class="pull-left"><i class="img-circle fa fa-comment'+(msgType=='new'?'':'-o')+'"></i></div>\
        <h4>'+dataObj.nickname+'<small><i class="fa fa-clock-o"></i> '+dataObj.msgTime+'</small></h4>\
    <p class="msg-content">'+dataObj.content+'</p>\
    </a></li>';

    if (msgType == 'new') {
        $("#new-msg-count-icon").html((parseInt($("#new-msg-count-icon").html())+1));
        $("#admin-msg-list").prepend(t_html);
    } else {
        $("#admin-msg-list").append(t_html);
    }

    // var msg = "["+dataObj.uid+"]"+dataObj.nickname+"["+dataObj.fd+"] Say:"+dataObj.content;
    // alert(msg);
}

function loadHistoryMsg(dataObj) {
    for (var i=0; i<dataObj.length; i++) {
        showMsg(dataObj[i]);
    }
}

function hideUser(dataObj) {
    $("#user_"+dataObj.fd).remove();
}

$("#admin-msg-list").on('mouseover','.fa-comment',function(){
    $(this).removeClass('fa-comment').addClass('fa-comment-o');
    $("#new-msg-count-icon").html((parseInt($("#new-msg-count-icon").html())-1));
});

function xssFilter(val) {
    val = val.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\x22/g, '&quot;').replace(/\x27/g, '&#39;');
    return val;
}


function GetDateT(time_stamp) {
    var d;
    d = new Date();

    if (time_stamp) {
        d.setTime(time_stamp * 1000);
    }
    var h, i, s;
    h = d.getHours();
    i = d.getMinutes();
    s = d.getSeconds();

    h = ( h < 10 ) ? '0' + h : h;
    i = ( i < 10 ) ? '0' + i : i;
    s = ( s < 10 ) ? '0' + s : s;
    return h + ":" + i + ":" + s;
}

function getRequest() {
    var url = location.search; // 获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);

        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            var decodeParam = decodeURIComponent(strs[i]);
            var param = decodeParam.split("=");
            theRequest[param[0]] = param[1];
        }

    }
    return theRequest;
}
