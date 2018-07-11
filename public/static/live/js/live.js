var wsUrl = "ws://eaimin.com:9501";

var websocket = new WebSocket(wsUrl);

websocket.onopen = function (ev) {
    console.log('conected-swoole-success');
}

websocket.onmessage = function (ev) {
    console.log('ws-server-return-data:' + ev.data);
}

websocket.onclose = function (ev) {
    console.log('close');
}

websocket.onerror = function (ev, e) {
    console.log('error:' + ev.data);
}