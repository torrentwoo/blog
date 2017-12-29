(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

;(function () {
    // Load and initialize CKEditor
    var editor = CKEDITOR.replace('writing-content', {
        customConfig: 'config-writing.js',
        height: 300
    });
    // Override the button save function
    CKEDITOR.plugins.registered['save'] = {
        init: function init(editor) {
            var command = editor.addCommand('save', {
                modes: {
                    wysiwyg: 1,
                    source: 1
                },
                exec: function exec(editor) {
                    // do something
                    var data = editor.getData();
                    alert(data);
                }
            });
            editor.ui.addButton('Save', { label: '保存草稿', command: 'save' });
        }
        // Upload and insert image
        // Upload and insert video
        // Upload and insert audio
        // Upload and insert other multi-media file
    };
})();

},{}]},{},[1]);
