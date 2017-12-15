;$(function() {
    try {
        var server = $('meta[name="app:url"]').attr('content'), port = $('meta[name="app:port"]').attr('content');
        var uid = parseInt($('meta[name="private:uid"]').attr('content'));
        var $hook = $('#nav-notification-hook');
        if (isNaN(uid)) {
            throw 'Your identifier is missing';
        }
        var socket = io(server + ':' + port);
        socket.on('notify-to.' + uid + ':app.notification', function(data) {
            if (data.hasNotification) {
                $('<i class="hint" title="您有新的消息或通知"></i>').appendTo($hook);
            }
        });
    } catch (e) {
        console.warn(e);
    }
});