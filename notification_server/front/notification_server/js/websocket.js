(function ($) {
    $(function () {
        window.ws = null;
        window.PORT_NOTIFICATION_SERVER = 2346;
        window.PROTOCOL_NOTIFICATION_SERVER = "ws";
        window.WS_CONNECTION = window.PROTOCOL_NOTIFICATION_SERVER + "://" + window.location.hostname + ":" + window.PORT_NOTIFICATION_SERVER;
        window.WS_COOKIE_NAME='idWS';

        function initCookie(){
            var expr = new RegExp(window.WS_COOKIE_NAME,'gm');
            if(document.cookie.match ( expr)){
                return false;
            }

            else{
                var idWS= Date.now()*Math.random();
                document.cookie = window.WS_COOKIE_NAME+"="+idWS;
                return true;
            }
        }

        function get_cookie ( cookie_name )
        {
            var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

            if ( results )
                return ( unescape ( results[2] ) );
            else
                return null;
        }

        function initWs() {
            console.log('initWs');
            window.ws = new WebSocket(window.WS_CONNECTION);
            window.ws.onopen = wsOnOpen;
            window.ws.onmessage = wsOnMessage;
            window.ws.onclose = wsOnClose;
        }

        function wsOnOpen() {
            console.log('wsOnOpen');
        }

        function wsOnMessage(e) {
            var data = $.parseJSON(e.data);
            if (e === undefined || window.location.pathname === "") return;


            switch (data.typeMessage) {
                case "item":
                case "order":
                    data=data.data;
                    for (var key in data) {
                        if( parseFloat(get_cookie('idWS'))===parseFloat(data[key].id)){
                            continue;
                        }
                        queueNotification.addElement(data[key]);
                    }
                    queueNotification.view();
                    break;
                case "productInfo":
                    data=data.data;
                    var countView=parseInt(data)-1;
                    $('div[data-current-product-view]').html('Данным товаром в данный момент интересуется '+ data+' человека, доступный остаток '+countView+' штук');
                    break;
            }

        }

        function wsOnClose() {
            setTimeout(initWs, 5e3);
        }

        function wsGetProductInfo(){
            window.ws.send(
                JSON.stringify(
                    { 
                        type:'productInfo',
                        data:$('div[data-product-id]').attr('data-product-id')
                    }
                )
            );
        }
        var queueNotification = {
            query: [],
            LIMIT: 100,
            COUNT_SHOW_NOTIFICATION: 3,
            IGNORE_URL: [],
            addElement: function add(data) {
                if (this.query.length > this.LIMIT) {
                    return
                }
                this.query.push(data)
            },
            view: function view() {
                if ($.inArray(window.location.pathname, this.IGNORE_URL) != -1) {
                    return false
                }
                for (var i = 0; i != this.COUNT_SHOW_NOTIFICATION; ++i) {
                    var notification = this.query.shift();
                    if (notification == undefined) {
                        break
                    }
                    var name = '<a href="' + notification.url + '">' + notification.name + "</a> ";
                    var price = parseInt(notification.price) + " ₽";
                    switch (notification.type) {
                        case"order":
                            var message = "Успешно купили " + name + " стоимостью " + price;
                            break;
                        case"item":
                            var message = "Только что в корзину добавили " + name + " стоимостью " + price;
                            break;
                        default:
                            return;
                            break;
                    }
                    $.jGrowl(message, {
                        life: 25e3,
                        theme: "notification_popup",
                        speed: "medium",
                        animateOpen: {height: "show", width: "show"},
                        position: "top-right",
                        animateClose: {height: "hide", width: "show"}
                    })
                }
            },
            delete: function _delete() {
            }
        };

        initCookie();
        initWs();
        if(section_position==='detail'){
            setTimeout(wsGetProductInfo, 30e3);
        }
        $.jGrowl.defaults.pool = queueNotification.COUNT_SHOW_NOTIFICATION;
        $.jGrowl.defaults.closerTemplate = '<div class="notification_popup">Скрыть уведомления</div>'
    })
})(jQuery);