;$(function() {
    // Listen on new incoming message
    var server = $('meta[name="app:url"]').attr('content'), port = $('meta[name="app:port"]').attr('content');
    var uid = parseInt($('meta[name="private:uid"]').attr('content'));
    var socket = io(server + ':' + port);
    socket.on('notify-to.' + uid + ':app.chatNotification', function(data) {
        console.log(data);
    });
    // Delete notification
    $('.media-quirk').on('click', 'a[data-target][data-handler][data-chat]', function() {
        var $btn = $(this);
        if (!confirm('是否确认删除与 ' + ($btn.data('chat') || '该用户') + ' 的所有对话')) {
            return false;
        }
        var $wrap = $($btn.data('target'));
        var handler = $btn.data('handler');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(handler, {
            '_method': 'DELETE'
        }, function(response) {
            if (!response.error) {
                $wrap.remove();
            } else {
                window.alert(response.message);
            }
        }, 'json');
    });
});