;(function() {
    try {
        // Parent form handling
        $('button[data-toggle="modal"][data-target="#loginModal"]').each(function(i) {
            $(this).bind('click', function() {
                $('#loginModal button[data-handler]').attr('data-form', $(this).data('trigger'));
            });
        });
        // All good
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#loginModal').on('click', 'button[id="ajaxLoginSubmit"]', function() {
            var $btn = $(this), $url = $btn.data('handler') || '/auth/ajaxLogin', $form = $('form' + $btn.data('form'));
            //console.log($form.length);

            var $username = $('#ajax-username'), $password = $('#ajax-password');
            var $remember = $('#ajax-remember').prop('checked');

            var $message  = $('#loginModalMessage');

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
                    // Process login request
                    $.post($url, {
                        "username": $username.val(),
                        "password": $password.val(),
                        "remember": $remember
                    }, function(response) {
                        if (!response.error) {
                            $('#loginModal').modal('hide');
                            if ($form.length) { // submit form if exists
                                $form.submit();
                            }
                            window.location.reload();
                        } else { // output error messages
                            $message.removeClass('hidden').text(response.message);
                        }
                    }, 'json');
            }
        })
    } catch (e) {}
})();