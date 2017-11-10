;(function() {
    try {
        if (typeof jQuery !== 'function')
            throw 'Error: jQuery is required while Ajax login is enable, but it is missing!';
        // All good
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#ajaxLoginSubmit').click(function() {
            var $username = $('#ajax-username'), $password = $('#ajax-password');
            var $remember = $('#ajax-remember').prop('checked');
            var $message  = $('#loginModalMessage');
            var $btn = $(this), $url = $btn.data('rel') || '/auth/ajaxLogin';
            switch (true) {
                // data validation
                case (!$username.val().length) :
                    $message.removeClass('hidden').text('帐号 不能为空');
                    $username.focus();
                    break;
                case (!$password.val().length) :
                    $message.removeClass('hidden').text('密码 不能为空');
                    $password.focus();
                    break;
                default :
                    $message.addClass('hidden').text('');
                    // data process
                    $.ajax({
                        url: $url,
                        type: 'POST',
                        data: {
                            'username': $username.val(),
                            'password': $password.val(),
                            'remember': $remember
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (!response.error) {
                                $('#loginModal').modal('hide');
                                var $form = $('form[data-interact="#loginModal"]');
                                if ($form.length) {
                                    $form.submit();
                                } else {
                                    location.reload();
                                }
                            } else { // output error messages
                                $message.removeClass('hidden').text(response.message);
                            }
                        }
                    });
            }
        })
    } catch (e) {
        window.alert(e);
    }
})();