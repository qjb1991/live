var wsUrl = "ws://eaimin.com:9501";

var websocket = new WebSocket(wsUrl);

websocket.onopen = function (ev) {
    console.log('conected-swoole-success');
}

websocket.onmessage = function (ev) {
    push(ev.data);
    console.log('ws-server-return-data:' + ev.data);
}

websocket.onclose = function (ev) {
    console.log('close');
}

websocket.onerror = function (ev, e) {
    console.log('error:' + ev.data);
}

function push(data) {
    data = JSON.parse(data);
    html = '<div class="frame">';
    html += '<h3 class="frame-header">';
    html += '<i class="icon iconfont icon-shijian"></i>第'+data.type+'节 01：30';
    html += '</h3 >';
    html +=	'<div class="frame-item">';
    html += '<span class="frame-dot"></span>';
    html += '<div class="frame-item-author">';
    if(data.logo){
        html += '<img src="'+data.logo+'" width="20px" height="20px" />'+data.title;
    }
	html +=	'</div>';
    html += '<p>test html</p>';
    html += '</div>';
    html +=	'</div>';

    $('#match-result').prepend(html);
}