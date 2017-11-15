(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

;(function () {
    try {
        if (typeof jQuery !== 'function') throw 'Error: jQuery is required while Ajax login is enable, but it is missing!';
        // Parent form handling
        $('button[data-toggle="modal"][data-target="#loginModal"]').each(function (i) {
            $(this).bind('click', function () {
                $('#loginModal button[data-handler]').attr('data-form', $(this).data('trigger'));
            });
        });
        // All good
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#loginModal').on('click', 'button[id="ajaxLoginSubmit"]', function () {
            var $username = $('#ajax-username'),
                $password = $('#ajax-password');
            var $remember = $('#ajax-remember').prop('checked');
            var $message = $('#loginModalMessage');
            var $btn = $(this),
                $url = $btn.data('handler') || '/auth/ajaxLogin',
                $form = $('form' + $btn.data('form'));
            //console.log($form.length);

            switch (true) {
                // data validation
                case !$username.val().length:
                    $message.removeClass('hidden').text('帐号 不能为空');
                    $username.focus();
                    break;
                case !$password.val().length:
                    $message.removeClass('hidden').text('密码 不能为空');
                    $password.focus();
                    break;
                default:
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
                        success: function success(response) {
                            if (!response.error) {
                                $('#loginModal').modal('hide');
                                if ($form.length) {
                                    // submit form if exists
                                    $form.submit();
                                }
                                window.location.reload();
                            } else {
                                // output error messages
                                $message.removeClass('hidden').text(response.message);
                            }
                        }
                    });
            }
        });
    } catch (e) {
        window.alert(e);
    }
})();

},{}]},{},[1]);
