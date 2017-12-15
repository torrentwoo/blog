(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

;$(function () {
    try {
        var server = $('meta[name="app:url"]').attr('content'),
            port = $('meta[name="app:port"]').attr('content');
        var uid = parseInt($('meta[name="private:uid"]').attr('content'));
        var $hook = $('#nav-notification-hook');
        if (isNaN(uid)) {
            throw 'Your identifier is missing';
        }
        var socket = io(server + ':' + port);
        socket.on('notify-to.' + uid + ':app.notification', function (data) {
            if (data.hasNotification) {
                $('<i class="hint" title="您有新的消息或通知"></i>').appendTo($hook);
            }
        });
    } catch (e) {
        console.warn(e);
    }
});

},{}]},{},[1]);
