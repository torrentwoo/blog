;(function() {
    try {
        if (typeof jQuery !== 'function')
            throw 'Error: jQuery is required while Ajax login is enable, but it is missing!';
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
            var $username = $('#ajax-username'), $password = $('#ajax-password');
            var $remember = $('#ajax-remember').prop('checked');
            var $message  = $('#loginModalMessage');
            var $btn = $(this), $url = $btn.data('handler') || '/auth/ajaxLogin', $form = $('form' + $btn.data('form'));
            //console.log($form.length);

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
                    // Process request
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
                                if ($form.length) { // submit form if exists
                                    $form.submit();
                                }
                                window.location.reload();
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