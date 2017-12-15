(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

;$(function () {
    // Listen on new incoming message
    var server = $('meta[name="app:url"]').attr('content'),
        port = $('meta[name="app:port"]').attr('content');
    var uid = parseInt($('meta[name="private:uid"]').attr('content'));
    var socket = io(server + ':' + port);
    socket.on('notify-to.' + uid + ':app.chatNotification', function (data) {
        console.log(data);
    });
    // Delete notification
    $('.media-quirk').on('click', 'a[data-target][data-handler][data-chat]', function () {
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
        }, function (response) {
            if (!response.error) {
                $wrap.remove();
            } else {
                window.alert(response.message);
            }
        }, 'json');
    });
});

},{}]},{},[1]);
