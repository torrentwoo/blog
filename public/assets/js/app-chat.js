(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

;$(function () {
    // Cache variables
    var _serverAddr = $('#serverAddr').val(),
        _serverPort = $('#serverPort').val();
    var _myselfId = $('#myselfId').val(),
        _myselfAvatar = $('#myselfAvatar').val();
    var _othersId = $('#othersId').val(),
        _othersAvatar = $('#othersAvatar').val();

    var dialogPane = $('div.dialog-box');
    var form = $('#chat-message'),
        formHandler = form.prop('action');
    var alertPane = $('div.alert', form),
        alertText = $('span.alert-response', form);
    var dialogContent = $('textarea[name="message"]', form);

    // Dialog pane initial
    scrollToBottom(dialogPane, 400); // page load, refresh

    // Listen form submit event
    form.bind('submit', function (e) {
        var e = e ? e : window.event.returnValue = false;
        e.preventDefault(); // prevent default event
        sendDialogContent();
    });
    // Listen specified keys stoke event (at specified area)
    dialogContent.bind('keydown', function (e) {
        var e = e || window.e;
        var keyCode = e.keyCode || e.which || e.charCode;
        var ctrlKey = e.ctrlKey || e.metaKey; // returns boolean
        if (ctrlKey && keyCode === 13) {
            sendDialogContent();
        }
    });

    // Handle send dialog message
    function sendDialogContent() {
        if (!$.trim(dialogContent.val()).length) {
            alertPane.show().find(alertText).text('站内信 的内容不可为空');
            return false;
        }
        if (dialogContent.val().length > 140) {
            alertPane.show().find(alertText).text('站内信 的内容不能大于 140 个字符');
            return false;
        }
        alertPane.hide().find(alertText).text('');
        $.post(formHandler, { // all good, no errors, send message
            "_method": 'POST',
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "message": dialogContent.val()
        }, function (response) {
            if (response.error !== true) {
                dialogContent.val(''); // clear the input area of dialog
                showDialogMessage('export', _myselfAvatar, response.outgoingMessage, response.delivered);
                scrollToBottom(dialogPane, 400);
            }
        }, 'json');
    }

    // Handle show message (put message append to dialog pane)
    function showDialogMessage(a, avatar, message, datetime) {
        var $template = $('<div class="dialog-' + a + '">' + '<div class="dialog-content">' + '<img class="img-circle avatar-xs dialog-avatar" src="' + avatar + '" />' + '<div class="well dialog-message">' + message + '</div>' + '<small class="dialog-timestamp text-muted">' + datetime + '</small>' + '</div>' + '</div>');
        $template.appendTo(dialogPane);
    }

    // Handle receive message via socket.io
    try {
        var socket = io(_serverAddr + ':' + _serverPort);
        var unique = uniqChannel(_myselfId, _othersId);
        socket.on('chat-with.' + unique + ':app.chat', function (data) {
            if (data.dialog.from_id != _myselfId) {
                showDialogMessage('import', _othersAvatar, data.dialog.content, data.datetime);
                scrollToBottom(dialogPane, 400);
            }
        });
    } catch (e) {}

    // Generate unique channel identifier
    function uniqChannel(one, other) {
        var pair = new Array(one, other);
        return pair.sort(function (a, b) {
            return a - b;
        }).join('-');
    }
});

var scrollToBottom = function scrollToBottom(jqObj, speed) {
    speed = speed || 400; // in millisecond
    jqObj.animate({
        scrollTop: jqObj[0].scrollHeight
    }, speed);
};

},{}]},{},[1]);
