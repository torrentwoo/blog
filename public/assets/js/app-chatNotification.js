(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

;$(function () {
    // Cache variables
    var container = $('#message-container');

    // Listen on incoming message
    var server = $('meta[name="app:url"]').attr('content'),
        port = $('meta[name="app:port"]').attr('content');
    var uid = parseInt($('meta[name="private:uid"]').attr('content'));
    var socket = io(server + ':' + port);

    socket.on('notify-to.' + uid + ':app.chatNotification', function (data) {

        var node = queryNode(container, 'a[data-target][data-handler][data-chat="' + data.from.name + '"]');
        //console.log(node);

        if (!node.length) {
            // newly incoming message
            var $template = $('<div class="media media-quirk" id="message-' + data.from.name + '">' + '<div class="media-left">' + '<img class="media-object img-circle avatar-sm" src="' + data.from.avatar + '" />' + '</div>' + '<div class="media-body">' + '<h3 class="media-heading h4">' + data.from.name + "\n" + '<small class="offset-right">' + data.message.datetime + '</small>' + "\n" + '<small class="offset-right"><span class="badge">1</span></small>' + '</h3>' + '<p class="text-muted">' + data.message.content + '</p>' + '</div>' + '<div class="media-right">' + '<div class="dropdown">' + '<a href="javascript:void(0);" class="btn btn-xs" id="dropdownMenu-' + data.from.name + '" data-toggle="dropdown" role="button">' + '<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>' + '<span class="sr-only">操作：</span>' + '</a>' + '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu-' + data.from.name + '">' + '<li><a class="caution bg-primary" href="' + data.message.show + '"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i>回复</a></li>' + '<li><a class="caution bg-danger" href="javascript:void(0);" data-target="#message-' + data.from.name + '" data-handler="' + data.message.delete + '" data-chat="' + data.from.name + '"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i>删除对话</a></li>' + '<li role="separator" class="divider"></li>' + '<li><a class="caution bg-danger" href="' + data.from.blacklist + '"><i class="glyphicon glyphicon-ban-circle" aria-hidden="true"></i>加入黑名单</a></li>' + '</ul>' + '</div>' + '</div>' + '</div>');
            container.find('.alert').remove();
            //$('div.page-header').after($template);
            container.prepend($template);
        } else {
            var item = container.find(node);
            var badgeCount = parseInt(item.find('.badge').text()) || 0;

            item.find('.media-body').replaceWith('<div class="media-body">' + '<h3 class="media-heading h4">' + data.from.name + "\n" + '<small class="offset-right">' + data.message.datetime + '</small>' + "\n" + '<small class="offset-right"><span class="badge">' + (badgeCount + 1) + '</span></small>' + '</h3>' + '<p class="text-muted">' + data.message.content + '</p>' + '</div>');
        }
    });

    // Delete notification
    container.on('click', 'a[data-target][data-handler][data-chat]', function () {
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
                var $a = $btn.remove(),
                    $b = $wrap.remove();
                $a = $b = null;
            } else {
                window.alert(response.message);
            }
        }, 'json');
    });

    // Supportive features
    function queryNode(container, identifier) {
        var ele = container.find(identifier);
        if (ele.length > 0) {
            return $(ele.data('target'));
        } else {
            return '';
        }
    }
});

},{}]},{},[1]);
